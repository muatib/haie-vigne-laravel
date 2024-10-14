<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRgpdFieldsToFormsTable extends Migration
{
    public function up()
    {
        Schema::table('forms', function (Blueprint $table) {
            $table->boolean('rgpd_consent')->default(false);
            $table->timestamp('rgpd_consent_date')->nullable();

        });
    }

    public function down()
    {
        Schema::table('forms', function (Blueprint $table) {
            $table->dropColumn('rgpd_consent');
            $table->dropColumn('rgpd_consent_date');

        });
    }
}
