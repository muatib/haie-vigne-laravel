<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImagePathAndAltTextToSliderImages2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('slider_images_2', function (Blueprint $table) {
            $table->string('image_path')->after('id');
            $table->string('alt_text')->after('image_path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('slider_images_2', function (Blueprint $table) {
            $table->dropColumn('image_path');
            $table->dropColumn('alt_text');
        });
    }
}

