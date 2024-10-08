<?php

namespace Database\Seeders;


use App\Models\User;
use App\Models\Activity;
// use Database\Seeders\ActivitiesTableSeeder as SeedersActivitiesTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);


        $this->call(SliderImagesSeeder::class);
        $this->call(SliderImages2Seeder::class);
        $this->call(ActivitiesTableSeeder::class);
    }
}
