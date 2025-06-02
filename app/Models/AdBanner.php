<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdBanner extends Model
{
    protected $table = 'adbanners';

    protected $fillable = ['image', 'caption', 'status'];
}