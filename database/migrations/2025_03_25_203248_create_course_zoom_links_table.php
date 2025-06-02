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
        Schema::create('course_zoom_links', function (Blueprint $table) {
            $table->id('zoom_link_id');
            $table->unsignedBigInteger('course_id');
            $table->string('week_name');  // e.g., Week 1, Week 2, or any specific name.
            $table->string('zoom_link');  // The Zoom meeting link
            $table->string('description')->nullable();  // Description of the meeting (Optional)
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
        Schema::dropIfExists('course_zoom_links');
    }
};
