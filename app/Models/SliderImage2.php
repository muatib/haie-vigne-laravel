<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SliderImage2 extends Model
{
    use HasFactory;

    protected $table = 'slider_images_2';

    protected $fillable = [
        'image_path',
        'image_data',
        'alt_text',
    ];

    public function actuality()
    {
        return $this->hasOne(Actuality::class, 'image_id');
    }
}
