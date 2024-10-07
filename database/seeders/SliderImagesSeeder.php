<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\SliderImage;
use Illuminate\Support\Facades\Storage;

class SliderImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = [
            ['file' => 'yoga.png', 'alt_text' => 'Yoga'],
            ['file' => 'gym.png', 'alt_text' => 'Gym'],
            ['file' => 'fitness.png', 'alt_text' => 'Fitness'],
            ['file' => 'pilates.png', 'alt_text' => 'Pilates'],
            ['file' => 'stretching.png', 'alt_text' => 'Stretching'],
        ];

        foreach ($images as $image) {
            $path = public_path('asset/img/' . $image['file']);

            if (file_exists($path)) {
                $imageData = file_get_contents($path);

                SliderImage::create([
                    'image_path' => $image['file'],
                    'image_data' => $imageData,
                    'alt_text' => $image['alt_text']
                ]);
            } else {
                $this->command->warn("L'image {$image['file']} n'a pas été trouvée.");
            }
        }

        $this->command->info('Les images du slider ont été ajoutées avec succès.');
    }
}
