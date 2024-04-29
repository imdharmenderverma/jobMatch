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
        Schema::table('user_previous_experiences', function (Blueprint $table) {
            $table->string('company')->nullable()->change();
            $table->string('industry')->nullable()->change();
            $table->string('title')->nullable()->change();
            $table->longText('job_duties')->nullable()->change();
            $table->boolean('tick_box')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_previous_experiences', function (Blueprint $table) {
            //
        });
    }
};
