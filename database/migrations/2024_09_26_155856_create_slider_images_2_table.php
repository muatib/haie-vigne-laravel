<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSliderImages2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider_images_2', function (Blueprint $table) {
            $table->id();
            $table->string('alt_text', 255);
            $table->string('image_path', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->longBlob('image_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slider_images_2');
    }
}
