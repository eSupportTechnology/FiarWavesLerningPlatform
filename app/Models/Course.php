<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $primaryKey = 'course_id'; // Custom primary key

    protected $fillable = [
        'name',
        'description',
        'duration',
        'total_price',
        'first_payment',
        'image',
        'video_link',
        'location',
        'mode',
        'branch_id',
    ];

    // === Relationships ===

    // Course Files
    public function files()
    {
        return $this->hasMany(CourseFile::class, 'course_id', 'course_id');
    }

    // Course Recordings
    public function recordings()
    {
        return $this->hasMany(CourseRecording::class, 'course_id', 'course_id');
    }

    // Course Zoom Links
    public function zoomLinks()
    {
        return $this->hasMany(CourseZoomLink::class, 'course_id', 'course_id');
    }

    // A course belongs to a branch
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    // Bookings for this course
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'course_id', 'course_id');
    }

    public function batches()
    {
        return $this->hasMany(Batch::class, 'course_id', 'course_id');
    }

}
