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
        'email',
        'password',
        'address',
        'contact_number',
        'status', // 0 = inactive, 1 = active
        'verification_code',
        'is_verified', // boolean
        'stu_id', // unique student id
        'batch_id', // related batch
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

}
