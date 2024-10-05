<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
class SliderImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path',
        'alt_text'
    ];
}
