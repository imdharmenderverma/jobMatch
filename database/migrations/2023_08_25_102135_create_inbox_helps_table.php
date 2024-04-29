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
        Schema::create('inbox_helps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('app_user_id')->nullable();
            $table->foreign('app_user_id')->references('id')->on('app_users')->onDelete('cascade');
            $table->unsignedBigInteger('recruiter_id')->nullable();
            $table->foreign('recruiter_id')->references('id')->on('recruiters')->onDelete('cascade');
            $table->string('question');
            $table->text('answer');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inbox_helps');
    }
};
