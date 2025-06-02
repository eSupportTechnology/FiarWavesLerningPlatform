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
        Schema::create('course_file_batch', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_file_id');
            $table->unsignedBigInteger('batch_id');
        
            $table->foreign('course_file_id')->references('file_id')->on('course_files')->onDelete('cascade');
            $table->foreign('batch_id')->references('id')->on('batches')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_file_batch');
    }
};
