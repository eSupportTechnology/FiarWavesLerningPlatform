<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    /**
     * Display the withdrawal page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $customerId = session('customer_id');
        $customer = Customer::where('user_id', $customerId)->first();
        return view('StudentDashboard.withdraw.withdraw', compact('customer'));
    }

    public function submitWithdraw(Request $request)
    {
        $customerId = session('customer_id');
        $customer = Customer::where('user_id', $customerId)->first();

        if (!$customer) {
            return redirect()->back()->with('error', 'Customer not found.');
        }

        // First withdrawal
        if (
            $customer->is_first_time_withdrawal == 0 &&
            $customer->left_side_points >= 1 &&
            $customer->right_side_points >= 1
        ) {
            $amount = 1000;
            $leftPointsUsed = 1;
            $rightPointsUsed = 1;

            $customer->is_first_time_withdrawal = 1;
        }

        // Subsequent withdrawals
        elseif (
            $customer->is_first_time_withdrawal == 1 &&
            $customer->left_side_points >= 2 &&
            $customer->right_side_points >= 2
        ) {
            $request->validate([
                'amount' => 'required|in:2000,4000,6000,8000,10000,12000',
            ]);

            $amount = (int) $request->amount;
            $pointsNeeded = $amount / 500 / 2;

            if (
                $customer->left_side_points < $pointsNeeded ||
                $customer->right_side_points < $pointsNeeded
            ) {
                return redirect()->back()->with('error', 'Insufficient points for the amount.');
            }

            $leftPointsUsed = $pointsNeeded;
            $rightPointsUsed = $pointsNeeded;
        }

        // Not eligible
        else {
            return redirect()->back()->with('error', 'You are not eligible to withdraw at this time.');
        }

        // Create Withdrawal Record
        Withdrawal::create([
            'customer_id' => $customer->user_id,
            'amount' => $amount,
            'bank_name' => $customer->bank_name,
            'bank_branch' => $customer->bank_branch,
            'account_name' => $customer->account_name,
            'account_number' => $customer->account_number,
            'status' => 'pending',
            'left_points_used' => $leftPointsUsed,
            'right_points_used' => $rightPointsUsed,
            'withdrawal_date' => now(),
            'withdrawal_time' => now()->format('H:i:s'),
            'withdrawal_type' => $customer->is_first_time_withdrawal ? 'first_time' : 'subsequent',
        ]);

        if($amount == 12000){
            // Deduct points
            $customer->left_side_points = 0;
            $customer->right_side_points = 0;
        } else{
            // Deduct points
            $customer->left_side_points -= $leftPointsUsed;
            $customer->right_side_points -= $rightPointsUsed;
        }

        $customer->save();

        return redirect()->route('customer.dashboard')->with('success', 'Your withdrawal request has been submitted successfully!');
    }
}
