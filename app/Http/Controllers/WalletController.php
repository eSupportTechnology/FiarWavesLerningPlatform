<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function history(Request $request)
    {
        $customerId = session('customer_id');
        if ($customerId === null) {
            return redirect()->route('customer.login')->with('error', 'Please log in to access your dashboard.');
        }
        $wallet = Wallet::with('transactions')
            ->where('customer_id', $customerId)
            ->first();
        if (!$wallet) {
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
        $search = $request->input('search');

        $walletTransaction = WalletTransaction::where('wallet_id', $wallet->id)
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('amount', 'like', "%{$search}%")
                        ->orWhere('transaction_type', 'like', "%{$search}%")
                        ->orWhere('status', 'like', "%{$search}%")
                        ->orWhereDate('transaction_date', $search);
                });
            })
            ->orderByDesc('transaction_date')
            ->paginate(10)
            ->appends(['search' => $search]);
        return view('StudentDashboard..withdraw.wallet-history', [
            'wallet' => $wallet,
            'walletTransaction' => $walletTransaction,
        ]);
    }
}
