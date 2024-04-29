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
        Schema::table('app_users', function (Blueprint $table) {
            $table->string('location_range')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->integer('min_income_expected')->nullable();
            $table->integer('max_income_expected')->nullable();
            $table->string('industry')->nullable();
            $table->boolean('open_to_negotiation')->default(false);
            $table->string('work_type')->nullable();
            $table->string('work_preference')->nullable();
            $table->longText('executive_summary')->nullable();
            $table->boolean('tell_us_about_screen')->default(false);
            $table->boolean('your_skill_screen')->default(false);
            $table->enum('user_statement_screen', [0,1,2,3,4,5])->default(0);
            $table->boolean('soft_skill_screen')->default(false);
            $table->boolean('your_previous_experience_screen')->default(false);
            $table->boolean('your_education_detail_screen')->default(false);
            $table->boolean('upload_video_screen')->default(false);
            $table->boolean('upload_cover_letter_screen')->default(false);
            $table->boolean('upload_resume_screen')->default(false);
            $table->boolean('your_information_screen')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('app_users', function (Blueprint $table) {
            //
        });
    }
};
