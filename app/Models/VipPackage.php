<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VipPackage extends Model
{
    use HasFactory;

    protected $table = 'vip_packages';

    protected $fillable = [
        'title',
        'price',
        'description',
        'status',
        'image',
        'video_link'
    ];

    // Optional: Accessor to format the price
    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 2);
    }

    // Optional: Scope for active packages
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
