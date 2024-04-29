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
        Schema::create('resume_builder_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->enum('resume_format_id', [1, 2, 3])->comment('1=resume', '2=resume_1', '3=resume_2');
            $table->longText('payment_responce');
            $table->boolean('resume_pdf_genreted')->default(false);
            $table->string('resume_pdf_url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resume_builder_subscriptions');
    }
};
