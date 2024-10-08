<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'title',
        'description',
        'location',
        'schedule',
        'coach',
        'additional_line1',
        'additional_line2',
    ];
    public function image()
{
    return $this->belongsTo(SliderImage::class);
}
}
