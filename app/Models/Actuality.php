<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actuality extends Model
{
    protected $fillable = [
        'title',
        'description',
        'location',
        'additional_info_1',
        'additional_info_2',
    ];

    public function image()
    {
        return $this->belongsTo(SliderImage2::class, 'image_id');
    }
}
