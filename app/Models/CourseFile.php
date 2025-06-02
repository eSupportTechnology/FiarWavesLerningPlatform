<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseFile extends Model
{
    use HasFactory;

    protected $primaryKey = 'file_id';

    protected $fillable = [
        'course_id',
        'file_name',
        'file_path',
        'file_type',
    ];

    // app/Models/CourseFile.php

    public function batches()
    {
        return $this->belongsToMany(Batch::class, 'course_file_batch', 'course_file_id', 'batch_id');
    }



}
