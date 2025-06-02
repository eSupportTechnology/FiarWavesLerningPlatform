<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Booking;
use App\Models\CustomerCourseBatch;
use App\Services\DialogSMSService;

class BackendTemplateController extends Controller
{
    public function index()
    {
        if (!session()->has('employee')) {
            return redirect()->route('admin.login');
        }

        return view('AdminDashboard.home');
    }


    // Show list of customers
    public function index1()
    {
        $customers = Customer::with('assignedBatches')->latest()->paginate(10);
        return view('AdminDashboard.customers.index', compact('customers'));
    }    

    // Toggle status (active/inactive)
    public function toggleStatus($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->status = !$customer->status;
        $customer->save();

        return redirect()->route('admin.customers.index')->with('success', 'Customer status updated.');
    }

    // Show customer details
    public function show($id)
    {
        $customer = Customer::with(['bookings.course'])->findOrFail($id);
        return view('AdminDashboard.customers.show', compact('customer'));
    }


    // Delete customer
    public function destroy($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            $customer->delete();

            return redirect()->route('admin.customers.index')->with('success', 'Customer deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Customer Deletion Failed: ' . $e->getMessage());
            return redirect()->route('admin.customers.index')->with('error', 'Failed to delete customer.');
        }
    }


    public function pendingOrders()
    {
        $pendingBookings = Booking::with(['customer', 'course.batches'])
            ->where('status', 'Confirmed')
            ->where('payment_method', 'Bank Transfer')
            ->orderBy('id', 'desc')
            ->get();

        $cardConfirmedBookings = Booking::with(['customer', 'course.batches'])
            ->where('status', 'Confirmed')
            ->where('payment_method', 'Card')
            ->orderBy('id', 'desc')
            ->get();

        return view('AdminDashboard.orders.pending', compact('pendingBookings', 'cardConfirmedBookings'));
    }


    public function halfPaidOrders()
    {
        $bookings = Booking::with(['customer', 'course'])
            ->where('status', 'Half')
            ->orderBy('id', 'desc')
            ->get();

        return view('AdminDashboard.orders.half', compact('bookings'));
    }


    public function successOrders()
    {
        $bookings = Booking::with(['customer', 'course'])
            ->where('status', 'Full')
            ->orderBy('id', 'desc')
            ->get();
        return view('AdminDashboard.orders.success', compact('bookings'));
    }

    public function updateOrderStatus($id, $status)
    {
        $booking = Booking::findOrFail($id);

        if (!in_array($status, ['Full', 'Half'])) {
            return redirect()->back()->with('error', 'Invalid status value.');
        }

        $booking->status = $status;
        $booking->save();

        return redirect()->back()->with('success', "Booking marked as $status successfully.");
    }


    public function updateBooking(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Half,Confirmed',
            'batch_id' => 'nullable|exists:batches,id',
        ]);

        $booking = Booking::with(['course', 'customer'])->findOrFail($id);

        // Update booking status
        $booking->status = $request->status;
        $booking->save();

        // Assign or update batch for this student-course
        if ($request->batch_id) {
            CustomerCourseBatch::updateOrCreate([
                'customer_id' => $booking->customer_id,
                'course_id'   => $booking->course_id,
            ], [
                'batch_id' => $request->batch_id,
            ]);
        }

        // Send SMS Notification
        try {
            $customer = $booking->customer;
            $course = $booking->course;
            $batchName = optional($course->batches->where('id', $request->batch_id)->first())->name ?? 'Batch';

            $smsService = new DialogSMSService();

            $message = "Hello {$customer->name},\n"
                        . "Student ID: {$customer->stu_id}\n"
                        . "Course: {$course->name}\n"
                        . "Batch: {$batchName}\n\n"
                        . "Your course is now active. You can access your course and start learning.\n"
                        . "Thank you - DSA Academy";

            $smsService->sendSMS($customer->contact_number, $message);
        } catch (\Exception $e) {
            \Log::error("Failed to send SMS to customer: " . $e->getMessage());
            // Optional: you can flash a warning if needed
        }

        return redirect()->back()->with('success', 'Booking, batch and SMS updated successfully.');
    }



    public function showOrder($id)
    {
        $booking = Booking::with(['customer', 'course'])->findOrFail($id);
        return view('AdminDashboard.orders.show', compact('booking'));
    }

}
