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
        Schema::create('job_apply_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('app_user_id');
            $table->unsignedBigInteger('job_id');
            $table->tinyInteger('status')->default(0)->comment('0 = Pending, 1 = Accepted, 2 = Rejected');
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_apply_users');
    }
};
