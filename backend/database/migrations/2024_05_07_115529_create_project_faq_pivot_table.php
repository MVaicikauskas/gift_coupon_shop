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
        Schema::create('project_faq', function (Blueprint $table) {
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->unsignedBigInteger('faq_id');
            $table->foreign('faq_id')->references('id')->on('faqs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_faq');
    }
};
