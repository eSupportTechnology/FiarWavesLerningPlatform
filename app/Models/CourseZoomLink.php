<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseZoomLink extends Model
{
    use HasFactory;

    protected $primaryKey = 'zoom_link_id';

    protected $fillable = [
        'course_id',
        'week_name',
        'zoom_link',
        'description',
    ];

    // In CourseZoomLink.php
    public function batches()
    {
        return $this->belongsToMany(Batch::class, 'course_zoom_link_batch', 'course_zoom_link_id', 'batch_id');
    }

}

