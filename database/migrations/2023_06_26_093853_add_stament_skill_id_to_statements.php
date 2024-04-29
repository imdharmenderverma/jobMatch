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
        Schema::table('statements', function (Blueprint $table) {
            $table->unsignedBigInteger('statement_skill_id')->after('id')->nullable();
            $table->enum('soft_skill_type',[1,2])->comment('1=PROFESSIONAL','2=LIFESTYLE')->after('statement_skill_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('statements', function (Blueprint $table) {
            //
        });
    }
};
