<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    protected $fillable = [
        'wallet_id',
        'transaction_type', // 'credit' or 'debit'
        'amount',
        'description',
        'status', // 'pending', 'completed', 'failed'
        'transaction_date',
        'reference_id', // Optional reference ID for the transaction
        'transaction_method', // Method of transaction (e.g., bank transfer, cash, etc.)
        'transaction_fee', // Transaction fee, if applicable
        'currency', // Currency type, default to LKR
        'transaction_type', // Type of transaction (e.g., deposit, withdrawal, transfer)
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'transaction_date' => 'datetime',
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class, 'wallet_id', 'id');
    }
}
