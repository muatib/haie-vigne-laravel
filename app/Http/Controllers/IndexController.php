<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SliderImage;
use App\Models\SliderImage2;
class IndexController extends Controller
{
    public function index()
    {
        $sliderImages = SliderImage::all();
        $sliderImages2 = SliderImage2::all();

        return view('index', compact('sliderImages', 'sliderImages2'));
    }
}

