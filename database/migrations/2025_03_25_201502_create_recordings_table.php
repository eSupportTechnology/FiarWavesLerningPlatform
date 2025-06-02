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
        Schema::create('course_recordings', function (Blueprint $table) {
            $table->id('recording_id');
            $table->unsignedBigInteger('course_id');
            $table->string('week_name'); // e.g., Week 1, Week 2 or any name given by the admin
            $table->string('recording_url'); // The URL to the recording
            $table->string('description')->nullable(); // Description of the recording (Optional)
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('course_id')->references('course_id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_recordings');
    }
};
