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
        Schema::create('app_users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->tinyInteger('gender')->comment('1 = Male, 2 = Female, 3 = Other');
            $table->string('phone_number')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->date('dob');
            $table->string('profile_photo_path', 2048)->nullable();
            $table->enum('status', ['0', '1'])->default('1');
            $table->integer('otp')->nullable();
            $table->string('device_token')->nullable();
            $table->string('access_token')->nullable();
            $table->boolean('show_profile')->default(false);
            $table->longText('address_state')->nullable();
            $table->longText('location')->nullable();
            $table->boolean('disable_job')->default(0)->comment('0 = false, 1 = True');
            $table->string('video')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_users');
    }
};
