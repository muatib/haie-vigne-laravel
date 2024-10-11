<?php

namespace App\Http\Controllers;

use App\Models\SliderImage;
use App\Models\SliderImage2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class IndexController extends Controller
{
    public function index()
{
    $sliderImages = SliderImage::all()->map(function ($image) {
        $image->full_path = "data:image/png;base64," . base64_encode($image->image_data);
        return $image;
    });

    $sliderImages2 = SliderImage2::all()->map(function ($image) {
        $image->full_path = "data:image/png;base64," . base64_encode($image->image_data);
        return $image;
    });

    return view('index', compact('sliderImages', 'sliderImages2'));
}

}

