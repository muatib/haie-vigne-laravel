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
public function updateSliderImages(Request $request)
{
    foreach ($request->file('images') as $id => $image) {
        $sliderImage = SliderImage::find($id);
        if ($sliderImage && $image) {
            $sliderImage->image_data = file_get_contents($image->getRealPath());
            $sliderImage->image_path = $image->getClientOriginalName();
            $sliderImage->save();
        }
    }
    return redirect()->back()->with('success', 'Images mises à jour avec succès.');
}
}

