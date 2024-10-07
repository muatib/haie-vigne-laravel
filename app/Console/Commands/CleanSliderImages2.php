<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SliderImage2;

class CleanSliderImages2 extends Command
{
    protected $signature = 'slider2:clean';
    protected $description = 'Clean slider images 2 with no data';

    public function handle()
    {
        $deleted = SliderImage2::whereRaw('LENGTH(image_data) = 0')->delete();
        $this->info("Deleted {$deleted} slider images 2 with no data.");
    }
}
