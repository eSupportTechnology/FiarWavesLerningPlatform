<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VipBooking extends Model
{
    protected $fillable = [
        'user_id',
        'vip_package_id',
        'payment_method',
        'receipt',
        'bank_name',
        'bank_branch',
        'transfer_date',
        'status',
    ];
    
}
