<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Booking;
use App\Models\CourseFile;
use App\Models\CourseRecording;
use App\Models\CourseZoomLink;
use App\Models\CustomerCourseBatch;
use Illuminate\Support\Facades\Hash;

class StudentDashboardController extends Controller
{
    public function index()
    {
        return view('StudentDashboard.home');
    }

    public function bookings()
    {
        $customerId = session('customer_id');

        $customer = Customer::where('user_id', $customerId)
            ->where('status', 1) // Only active customers
            ->first();

        if (!$customer) {
            // Optionally handle inactive or non-existent customer
            return redirect()->back()->with('error', 'Access denied or customer inactive.');
        }

        $bookings = $customer->bookings()
            ->with('course')
            ->whereIn('status', ['Confirmed', 'Half'])
            ->get();

        return view('StudentDashboard.course.main', compact('bookings'));
    }


    public function courseDetails($bookingId)
    {
        $customerId = session('customer_id');

        $booking = Booking::with('course')
            ->where('customer_id', $customerId)
            ->where('id', $bookingId)
            ->firstOrFail();

        return view('StudentDashboard.course.view', compact('booking'));
    }

    public function courseFiles($bookingId)
    {
        $customerId = session('customer_id');

        // Get the booking and related course
        $booking = Booking::with('course')->where('id', $bookingId)
            ->where('customer_id', $customerId)
            ->firstOrFail();

        // Get the customer's batch for that course
        $customerBatch = CustomerCourseBatch::where('customer_id', $customerId)
            ->where('course_id', $booking->course_id)
            ->first();

        if (!$customerBatch) {
            abort(403, 'You are not assigned to a batch for this course.');
        }

        // Get course files for that course and batch
        $files = \DB::table('course_files as cf')
            ->join('course_file_batch as cfb', 'cf.file_id', '=', 'cfb.course_file_id')
            ->where('cf.course_id', $booking->course_id)
            ->where('cfb.batch_id', $customerBatch->batch_id)
            ->select('cf.*')
            ->get();

        return view('StudentDashboard.course.files', compact('files', 'booking'));
    }


    public function courseRecordings($bookingId)
    {
        $customerId = session('customer_id');

        // Get booking
        $booking = Booking::with('course')->where('id', $bookingId)
            ->where('customer_id', $customerId)
            ->firstOrFail();

        // Get customer's batch
        $customerBatch = CustomerCourseBatch::where('customer_id', $customerId)
            ->where('course_id', $booking->course_id)
            ->first();

        if (!$customerBatch) {
            abort(403, 'You are not assigned to a batch for this course.');
        }

        // Get course recordings filtered by course and batch
        $recordings = \DB::table('course_recordings as cr')
            ->join('course_recording_batch as crb', 'cr.recording_id', '=', 'crb.course_recording_id')
            ->where('cr.course_id', $booking->course_id)
            ->where('crb.batch_id', $customerBatch->batch_id)
            ->select('cr.*')
            ->get();

        return view('StudentDashboard.course.recordings', compact('recordings', 'booking'));
    }

    public function courseZoomLinks($bookingId)
    {
        $customerId = session('customer_id');

        // Get booking
        $booking = Booking::with('course')->where('id', $bookingId)
            ->where('customer_id', $customerId)
            ->firstOrFail();

        // Get customer's batch
        $customerBatch = CustomerCourseBatch::where('customer_id', $customerId)
            ->where('course_id', $booking->course_id)
            ->first();

        if (!$customerBatch) {
            abort(403, 'You are not assigned to a batch for this course.');
        }

        // Get zoom links filtered by course and batch
        $zoomLinks = \DB::table('course_zoom_links as czl')
            ->join('course_zoom_link_batch as czlb', 'czl.zoom_link_id', '=', 'czlb.course_zoom_link_id')
            ->where('czl.course_id', $booking->course_id)
            ->where('czlb.batch_id', $customerBatch->batch_id)
            ->select('czl.*')
            ->get();

        return view('StudentDashboard.course.zoom-links', compact('zoomLinks', 'booking'));
    }

    public function profile()
    {
        $customerId = session('customer_id');
        $customer = Customer::findOrFail($customerId);

        return view('StudentDashboard.profile', compact('customer'));
    }

    public function updateProfile(Request $request)
    {
        $customerId = session('customer_id');
        $customer = Customer::findOrFail($customerId);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customerId,
            'phone' => 'nullable|string|max:20',
        ]);

        $customer->update($validated);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    

    public function updatePassword(Request $request)
    {
        $customerId = session('customer_id');
        $customer = Customer::findOrFail($customerId);

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        if (!Hash::check($request->current_password, $customer->password)) {
            return back()->with('password_error', 'Current password is incorrect.');
        }

        $customer->password = Hash::make($request->new_password);
        $customer->save();

        return back()->with('password_success', 'Password updated successfully!');
    }






}
