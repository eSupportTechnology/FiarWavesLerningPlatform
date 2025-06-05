<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'amount',
        'bank_name',
        'bank_branch',
        'account_name',
        'account_number',
        'status',
        'left_points_used',
        'right_points_used',
        'withdrawal_date',
        'withdrawal_time',
        'withdrawal_type',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'user_id');
    }
}
