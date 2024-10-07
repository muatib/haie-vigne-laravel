<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SliderImage;

class CleanSliderImages extends Command
{
    protected $signature = 'slider:clean';
    protected $description = 'Clean slider images with no data';

    public function handle()
    {
        $deleted = SliderImage::whereRaw('LENGTH(image_data) = 0')->delete();
        $this->info("Deleted {$deleted} slider images with no data.");
    }
}
