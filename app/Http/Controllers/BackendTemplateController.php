<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Booking;
use App\Models\CustomerCourseBatch;
use App\Services\DialogSMSService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
            Log::error("Failed to send SMS to customer: " . $e->getMessage());
            // Optional: you can flash a warning if needed
        }

        return redirect()->back()->with('success', 'Booking, batch and SMS updated successfully.');
    }



    public function showOrder($id)
    {
        $booking = Booking::with(['customer', 'course'])->findOrFail($id);
        return view('AdminDashboard.orders.show', compact('booking'));
    }

    public function updateKyc(Request $request, Customer $customer)
    {
        $action = $request->input('action');

        if ($action === 'approve') {
            $customer->kyc_status = 'approved';
            $message = 'KYC approved successfully.';
        } elseif ($action === 'reject') {
            $customer->kyc_status = 'rejected';
            $message = 'KYC rejected successfully.';
        } else {
            return redirect()->back()->with('error', 'Invalid action.');
        }

        $customer->save();

        return redirect()->back()->with('success', $message);
    }

    public function updateBank(Request $request, Customer $customer)
    {
        $action = $request->input('action');

        if ($action === 'approve') {
            $customer->bank_status = 'approved';
            $message = 'Bank approved successfully.';
        } elseif ($action === 'reject') {
            $customer->bank_status = 'rejected';
            $message = 'Bank rejected successfully.';
        } else {
            return redirect()->back()->with('error', 'Invalid action.');
        }

        $customer->save();

        return redirect()->back()->with('success', $message);
    }

    public function customerUpdate(Request $request, $user_id)
    {
        $customer = Customer::findOrFail($user_id);

        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->user_id . ',user_id',
            'contact_number' => 'required|string|unique:customers,contact_number,' . $customer->user_id . ',user_id',

            // Optional fields
            'address' => 'nullable|string',
            'street' => 'nullable|string',
            'city' => 'nullable|string',
            'district' => 'nullable|string',
            'postal_code' => 'nullable|string',
            'bank_name' => 'nullable|string',
            'bank_branch' => 'nullable|string',
            'account_name' => 'nullable|string',
            'account_number' => 'nullable|string',
            'account_type' => 'nullable|string',

            'kyc_doc_type' => 'nullable|in:NIC,DL,Passport',
            'kyc_doc_number' => 'nullable|string',
            'kyc_status' => 'nullable|in:pending,approved,rejected',
            'bank_status' => 'nullable|in:pending,approved,rejected',
            'status' => 'required|boolean',

            'kyc_doc_front' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kyc_doc_back' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bank_front_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bank_back_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Assign standard fields
        $customer->fname = $validated['fname'];
        $customer->lname = $validated['lname'];
        $customer->email = $validated['email'];
        $customer->contact_number = $validated['contact_number'];
        $customer->address = $validated['address'] ?? null;

        // Assign optional fields
        $customer->street = $validated['street'] ?? null;
        $customer->city = $validated['city'] ?? null;
        $customer->district = $validated['district'] ?? null;
        $customer->postal_code = $validated['postal_code'] ?? null;

        $customer->bank_name = $validated['bank_name'] ?? null;
        $customer->bank_branch = $validated['bank_branch'] ?? null;
        $customer->account_name = $validated['account_name'] ?? null;
        $customer->account_number = $validated['account_number'] ?? null;
        $customer->account_type = $validated['account_type'] ?? null;

        $customer->kyc_doc_type = $validated['kyc_doc_type'] ?? null;
        $customer->kyc_doc_number = $validated['kyc_doc_number'] ?? null;
        $customer->kyc_status = $validated['kyc_status'] ?? null;
        $customer->bank_status = $validated['bank_status'] ?? null;
        $customer->status = $validated['status'];

        // Handle file uploads (with optional existing image cleanup if needed)
        if ($request->hasFile('kyc_doc_front')) {
            if ($customer->kyc_doc_front) {
                Storage::delete('public/' . $customer->kyc_doc_front);
            }
            if ($customer->kyc_doc_front && Storage::disk('public')->exists($customer->kyc_doc_front)) {
                Storage::disk('public')->delete($customer->kyc_doc_front);
            }
            $customer->kyc_doc_front = $request->file('kyc_doc_front')->store('kyc', 'public');
        }
        if ($request->hasFile('kyc_doc_back')) {
            if ($customer->kyc_doc_back) {
                Storage::delete('public/' . $customer->kyc_doc_back);
            }
            if ($customer->kyc_doc_back && Storage::disk('public')->exists($customer->kyc_doc_back)) {
                Storage::disk('public')->delete($customer->kyc_doc_back);
            }
            $customer->kyc_doc_back = $request->file('kyc_doc_back')->store('kyc', 'public');
        }
        if ($request->hasFile('bank_front_image')) {
            if ($customer->bank_front_image) {
                Storage::delete('public/' . $customer->bank_front_image);
            }
            if ($customer->bank_front_image && Storage::disk('public')->exists($customer->bank_front_image)) {
                Storage::disk('public')->delete($customer->bank_front_image);
            }
            $customer->bank_front_image = $request->file('bank_front_image')->store('bank', 'public');
        }
        if ($request->hasFile('bank_back_image')) {
            if ($customer->bank_back_image) {
                Storage::delete('public/' . $customer->bank_back_image);
            }
            if ($customer->bank_back_image && Storage::disk('public')->exists($customer->bank_back_image)) {
                Storage::disk('public')->delete($customer->bank_back_image);
            }
            $customer->bank_back_image = $request->file('bank_back_image')->store('bank', 'public');
        }

        $customer->save();

        return back()->with('success', 'Customer updated successfully.');
    }
}
