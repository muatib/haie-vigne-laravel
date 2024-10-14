<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('first_name', 191);
            $table->string('last_name', 191);
            $table->string('email', 191)->unique();
            $table->string('address', 191);
            $table->string('phone', 191)->unique();
            $table->json('courses')->nullable();
            $table->string('question1')->nullable();
            $table->string('question2')->nullable();
            $table->string('question3')->nullable();
            $table->string('question4')->nullable();
            $table->string('question5')->nullable();
            $table->string('question6')->nullable();
            $table->string('question7')->nullable();
            $table->string('question8')->nullable();
            $table->string('question9')->nullable();
            $table->string('file_upload')->nullable();
            $table->timestamps();
            $table->decimal('total', 10, 2)->nullable();
            $table->string('payment_method')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('file_name')->nullable();
            $table->boolean('rgpd_consent')->default(false);
            $table->date('rgpd_consent_date')->nullable();
            $table->boolean('needs_medical_certificate')->default(false);
            $table->date('medical_certificate_deadline')->nullable();
            $table->enum('registration_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forms');
    }
};
