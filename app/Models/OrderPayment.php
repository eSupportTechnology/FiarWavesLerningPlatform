<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_id';

    protected $fillable = [
        'user_id',
        'course_id',
        'total_amount',
        'paid_amount',
        'status',
        'order_date',
    ];

    // Relationship with Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'user_id', 'user_id');
    }

    // Relationship with Course
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'course_id');
    }

    // Relationship with Order Payments
    public function payments()
    {
        return $this->hasMany(OrderPayment::class, 'order_id', 'order_id');
    }
}
