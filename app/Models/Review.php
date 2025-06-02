<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'student_name',
        'rating',
        'comment',
        'image',
        'status',
    ];

}
