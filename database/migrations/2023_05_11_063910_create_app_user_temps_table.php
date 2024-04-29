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
        Schema::create('app_user_temps', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('password');
            $table->tinyInteger('gender')->comment('1 = Male, 2 = Female, 3 = Other');
            $table->date('dob')->nullable();
            $table->boolean('show_profile')->default(false);
            $table->string('profile_photo_path', 2048)->nullable();
            $table->integer('otp')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_user_temps');
    }
};
