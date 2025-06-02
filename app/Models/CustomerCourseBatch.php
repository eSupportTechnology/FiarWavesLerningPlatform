<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/CustomerCourseBatch.php

class CustomerCourseBatch extends Model
{
    protected $table = 'customer_course_batch';

    protected $fillable = [
        'customer_id',
        'course_id',
        'batch_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'user_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }
}

