<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Wallet;
use App\Models\WalletTransaction;
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
        $wallet = Wallet::where('customer_id', $customerId)->first();
        if(!$wallet){
            // Create a new wallet if it doesn't exist
            $wallet = Wallet::create([
                'customer_id' => $customerId,
                'balance' => 0,
                'total_deposited' => 0,
                'total_withdrawn' => 0,
                'status' => 'active', // Active
                'currency' => 'LKR', // Default currency
            ]);
        }
        return view('StudentDashboard.withdraw.withdraw', compact('customer','wallet'));
    }

    public function submitWithdraw(Request $request)
    {
        $customerId = session('customer_id');
        $customer = Customer::where('user_id', $customerId)->first();

        if (!$customer) {
            return redirect()->back()->with('error', 'Customer not found.');
        }

        // Validate the withdrawal request
        $request->validate([
            'amount' => 'required|numeric|min:1000',
        ]);
        $amount = $request->input('amount');

        // Create Withdrawal Record
        Withdrawal::create([
            'customer_id' => $customer->user_id,
            'amount' => $amount,
            'bank_name' => $customer->bank_name,
            'bank_branch' => $customer->bank_branch,
            'account_name' => $customer->account_name,
            'account_number' => $customer->account_number,
            'status' => 'pending',
            'left_points_used' => $amount/1000,
            'right_points_used' => $amount / 1000,
            'withdrawal_date' => now(),
            'withdrawal_time' => now()->format('H:i:s'),
            'withdrawal_type' => $customer->is_first_time_withdrawal ? 'first_time' : 'subsequent',
        ]);

        //update wallet
        $wallet = Wallet::where('customer_id', $customerId)->first();
        if ($wallet) {
            $wallet->balance -= $amount;
            $wallet->total_withdrawn += $amount;
            // Create a wallet transaction record
            $wallet->transactions()->create([
                'transaction_type' => 'withdrawal',
                'amount' => $amount,
                'description' => 'Withdrawal request submitted',
                'status' => 'pending',
            ]);

            $wallet->save();

        } else {
            return redirect()->back()->with('error', 'Wallet not found.');
        }


        return redirect()->route('customer.dashboard')->with('success', 'Your withdrawal request has been submitted successfully!');
    }

    public function withdrawHistory()
    {
        $customerId = session('customer_id');
        $withdrawals = Withdrawal::where('customer_id', $customerId)->get();
        return view('StudentDashboard.withdraw.withdraw_history', compact('withdrawals'));
    }

    public function adminIndex()
    {
        $withdrawals = Withdrawal::all();
        return view('AdminDashboard.withdraw.withdraw', compact('withdrawals'));
    }

    public function pendingWithdrawals()
    {
        $withdrawals = Withdrawal::where('status', 'pending')->with('customer')->latest()->get();
        return view('AdminDashboard.withdraw.pending', compact('withdrawals'));
    }

    public function approvedWithdrawals()
    {
        $withdrawals = Withdrawal::where('status', 'approved')->with('customer')->latest()->get();
        return view('AdminDashboard.withdraw.approved', compact('withdrawals'));
    }

    public function rejectedWithdrawals()
    {
        $withdrawals = Withdrawal::where('status', 'rejected')->with('customer')->latest()->get();
        return view('AdminDashboard.withdraw.rejected', compact('withdrawals'));
    }

    // Approve a withdrawal
    public function approve($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);

        if ($withdrawal->status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending withdrawals can be approved.');
        }

        // Update the customer's wallet TRansaction
        $wallet = Wallet::where('customer_id', $withdrawal->customer_id)->first();

        $walletTransaction = WalletTransaction::where('wallet_id', $wallet->id)
            ->where('transaction_type', 'withdrawal')
            ->where('status', 'pending')
            ->where('amount', $withdrawal->amount)
            // ->where('created_at', $withdrawal->created_at)
            ->first();
        if (!$walletTransaction) {
            return redirect()->back()->with('error', 'Wallet transaction not found for this withdrawal.');
        }

        $walletTransaction->status = 'completed';
        $walletTransaction->save();

        $withdrawal->status = 'approved';
        $withdrawal->updated_at = now(); // optional timestamp
        $withdrawal->save();





        return redirect()->back()->with('success', 'Withdrawal approved successfully.');
    }

    // Reject a withdrawal
    public function reject($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);

        if ($withdrawal->status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending withdrawals can be rejected.');
        }

        // Update the customer's wallet TRansaction
        $wallet = Wallet::where('customer_id', $withdrawal->customer_id)->first();

        $walletTransaction = WalletTransaction::where('wallet_id', $wallet->id)
            ->where('transaction_type', 'withdrawal')
            ->where('status', 'pending')
            ->where('amount', $withdrawal->amount)
            // ->where('created_at', $withdrawal->created_at)
            ->first();
        if (!$walletTransaction) {
            return redirect()->back()->with('error', 'Wallet transaction not found for this withdrawal.');
        }

        $walletTransaction->status = 'failed';
        $walletTransaction->save();

        $withdrawal->status = 'rejected';
        $withdrawal->updated_at = now(); // optional timestamp
        $withdrawal->save();

        return redirect()->back()->with('success', 'Withdrawal rejected successfully.');
    }

    // Show withdrawal details
    public function show($id)
    {
        $withdrawal = Withdrawal::with('customer')->findOrFail($id);

        return view('AdminDashboard.withdraw.withdraw', compact('withdrawal'));
    }
}
