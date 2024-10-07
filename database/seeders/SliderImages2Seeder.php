<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SliderImage2;
use Illuminate\Support\Facades\File;

class SliderImages2Seeder extends Seeder
{
    public function run()
    {
        $imageFiles = ['event.png', 'event2.png', 'event3.png'];

        foreach ($imageFiles as $file) {
            $path = public_path('asset/img/' . $file);
            if (File::exists($path)) {
                SliderImage2::create([
                    'image_path' => $file,
                    'image_data' => file_get_contents($path),
                    'alt_text' => pathinfo($file, PATHINFO_FILENAME)
                ]);
            }
        }
    }
}
