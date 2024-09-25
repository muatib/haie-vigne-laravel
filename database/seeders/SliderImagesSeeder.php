<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\SliderImage;

class SliderImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('slider_images')->insert([
            ['image_path' => 'asset/img/yoga.png', 'alt_text' => ''],
            ['image_path' => 'asset/img/gym.png', 'alt_text' => ''],
            ['image_path' => 'asset/img/fitness.png', 'alt_text' => ''],
            ['image_path' => 'asset/img/pilates.png', 'alt_text' => ''],
            ['image_path' => 'asset/img/stretching.png', 'alt_text' => ''],
            // Ajoutez autant d'images que nécessaire
        ]);

        // Ou utilisez le modèle SliderImage pour créer des enregistrements
        // SliderImage::create(['image_path' => 'chemin/vers/image1.jpg', 'alt_text' => 'Texte alternatif pour l\'image 1']);
        // SliderImage::create(['image_path' => 'chemin/vers/image2.jpg', 'alt_text' => 'Texte alternatif pour l\'image 2']);
    }
}
