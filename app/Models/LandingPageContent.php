<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingPageContent extends Model
{
    protected $fillable = [
        'email',
        'number_1',
        'number_2',
        'red_title',
        'main_title',
        'title_description',
        'middle_title',
        'middle_title_description',
        'footer_description',
        'about_title',
        'about_title_description',
        'address',
        'website',
        'location_link',
        'vision',
        'mission',
        // Add any other fields that are part of the landing page content
    ];
}
