<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\SliderImage2;

class SliderImages2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('slider_images_2')->insert([
            ['image_path' => 'asset/img/event.png', 'alt_text' => ''],
            ['image_path' => 'asset/img/event2.jpg', 'alt_text' => ''],
            ['image_path' => 'asset/img/event3.jpg', 'alt_text' => ''],
            // Ajoutez autant d'images que nécessaire
        ]);

        // Ou utilisez le modèle SliderImage2 pour créer des enregistrements
        // SliderImage2::create(['image_path' => 'chemin/vers/image1.jpg', 'alt_text' => 'Texte alternatif pour l\'image 1']);
        // SliderImage2::create(['image_path' => 'chemin/vers/image2.jpg', 'alt_text' => 'Texte alternatif pour l\'image 2']);
    }
}

