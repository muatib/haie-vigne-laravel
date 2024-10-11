<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ActualitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('actualities')->insert([
            [
                'title' => 'Carnaval de la Haie-Vigné',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur, fugiat?',
                'location' => 'Centre ville haie-Vigné.',
                'additional_info_1' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque eligendi itaque quod modi minus enim laboriosam suscipit eius temporibus aliquid.',
                'additional_info_2' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit labore dicta tempora sapiente animi. Eos.',
                'image_id' => 1, // Assumes that the image with id 1 exists in slider_image_2
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Carnaval de la Haie-Vigné',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur, fugiat?',
                'location' => 'Centre ville haie-Vigné.',
                'additional_info_1' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque eligendi itaque quod modi minus enim laboriosam suscipit eius temporibus aliquid.',
                'additional_info_2' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Adipisci voluptatem inventore totam eaque iusto libero!',
                'image_id' => 2, // Assumes that the image with id 2 exists in slider_image_2
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Carnaval de la Haie-Vigné',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur, fugiat?',
                'location' => 'Centre ville haie-Vigné.',
                'additional_info_1' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque eligendi itaque quod modi minus enim laboriosam suscipit eius temporibus aliquid.',
                'additional_info_2' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Adipisci voluptatem inventore totam eaque iusto libero!',
                'image_id' => 3, // Assumes that the image with id 3 exists in slider_image_2
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
