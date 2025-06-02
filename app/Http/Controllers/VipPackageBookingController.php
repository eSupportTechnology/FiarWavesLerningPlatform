<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VipPackage;
use App\Models\VipBooking;
use Illuminate\Support\Facades\Log;

class VipPackageBookingController extends Controller
{
    // Show VIP Package Booking Form
    public function create($id)
    {
        if (!session()->has('customer_id')) {
            return redirect()->route('customer.login')->with('error', 'Please login to book this course.');
        }

        $package = VipPackage::findOrFail($id);

        return view('frontend.book', compact('package'));
    }

    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'package_id' => 'required|exists:vip_packages,id',
            'payment_method' => 'required|in:Card,Bank Transfer',
            'receipt'        => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'bank_name'      => 'nullable|string|max:255',
            'bank_branch'    => 'nullable|string|max:255',
            'transfer_date'  => 'nullable|date',
        ]);

        try {
            $data = [
                'user_id'        => session('customer_id'), // Assume user is logged in
                'vip_package_id' => $request->package_id,
                'payment_method' => $request->payment_method,
                'bank_name'      => $request->bank_name,
                'bank_branch'    => $request->bank_branch,
                'transfer_date'  => $request->transfer_date,
                'status'         => 'Pending',
            ];

            // Handle receipt upload if any
            if ($request->hasFile('receipt')) {
                $data['receipt'] = $request->file('receipt')->store('vip_receipts', 'public');
            }

            // Save booking
            VipBooking::create($data);

            return redirect()->route('booking.success')->with('success', 'Your VIP booking was submitted successfully!');
        } catch (\Throwable $e) {
            Log::error('VIP Booking Failed: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong while submitting your booking.');
        }
    }
}
