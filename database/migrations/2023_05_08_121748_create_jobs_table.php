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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->string('role_name')->nullable();
            $table->string('company_name')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->longText('description');
            $table->longText('requirement');
            $table->longText('location');
            $table->string('skill_id');
            $table->string('child_skill_id')->nullable();
            $table->bigInteger('experience');
            $table->bigInteger('type_of_work');
            $table->bigInteger('industry');
            $table->string('salary_range');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
