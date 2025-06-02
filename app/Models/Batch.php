<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $fillable = ['course_id', 'name', 'start_date', 'end_date'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }



    public function courseFiles()
    {
        return $this->belongsToMany(CourseFile::class, 'course_file_batch', 'batch_id', 'course_file_id');
    }


    public function recordings()
    {
        return $this->belongsToMany(CourseRecording::class, 'course_recording_batch', 'batch_id', 'course_recording_id');
    }


    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}

