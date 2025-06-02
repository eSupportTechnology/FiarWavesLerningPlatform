<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YoutubeVideo extends Model
{

    protected $table = 'youtube_videos';

    protected $fillable = [
        'title',
        'youtube_url',
        'thumbnail',
    ];
}
