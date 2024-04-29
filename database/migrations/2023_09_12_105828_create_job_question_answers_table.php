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
        Schema::create('job_question_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('app_user_id');
            $table->foreign('app_user_id')->references('id')->on('app_users')->onDelete('cascade');
            $table->unsignedBigInteger('job_question_id');
            $table->foreign('job_question_id')->references('id')->on('job_questions')->onDelete('cascade');
            $table->longText('answer');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_question_answers');
    }
};
