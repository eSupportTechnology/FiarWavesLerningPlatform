<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    protected $fillable = [
        'facebook_link',
        'youtube_link',
        'tiktok_link',
        'instagram_link',
        'whatsapp_link',
    ];
}
