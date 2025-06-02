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
        Schema::create('courses', function (Blueprint $table) {
            $table->id('course_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('duration'); // Duration in days
            $table->decimal('total_price', 10, 2);
            $table->decimal('first_payment', 10, 2);
            $table->string('image')->nullable();
            $table->string('location')->nullable(); // e.g., "Colombo Branch", "Online"
            $table->enum('mode', ['online', 'offline', 'hybrid'])->default('online');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->onDelete('set null');
            $table->timestamps(); // Includes created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
