<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'name',
        'fname',
        'lname',
        'email',
        'password',
        'address',
        'contact_number',
        'status', // 0 = inactive, 1 = active
        'verification_code',
        'is_verified', // boolean
        'stu_id', // unique student id
        'batch_id', // related batch
        'sponsor_id', // ID of the sponsor
        'left_child_id', // ID of the left child
        'right_child_id', // ID of the right child
        'street',
        'city',
        'district',
        'postal_code',
        'bank_name',
        'bank_branch',
        'account_name',
        'account_number',
        'account_type',
        'invite_code',
        'is_side_selected',
        'left_side_points', // Points on the left side
        'right_side_points', // Points on the right side
        'is_first_time_withdrawal', // Flag for first time withdrawal
        'kyc_doc_type', // Type of KYC document
        'kyc_doc_number', // Number of KYC document
        'kyc_doc_front', // Front image of KYC document
        'kyc_doc_back', // Back image of KYC document
        'kyc_status',
        'total_left_points',
        'total_right_points',
        'active_left_points',
        'active_right_points',
        'used_left_points',
        'used_right_points',
        'bank_front_image', // New column for bank front image
        'bank_back_image', // New column for bank back image
        'bank_status', // New column for bank status
        'email_verification_token',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'email_verified_at' => 'datetime',
    ];


    public function bookings()
    {
        return $this->hasMany(Booking::class, 'customer_id', 'user_id');
    }

    public function assignedBatches()
    {
        return $this->hasMany(CustomerCourseBatch::class, 'customer_id', 'user_id')->with(['course', 'batch']);
    }
    public function wallet()
    {
        return $this->hasOne(Wallet::class, 'customer_id', 'user_id');
    }

}
