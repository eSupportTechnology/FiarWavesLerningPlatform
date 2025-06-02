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
        Schema::create('vip_packages', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // e.g., Daily Signals 5
            $table->integer('price'); // e.g., 22000
            $table->text('description')->nullable();
            $table->string('image')->nullable(); // New image field (path to the image)
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vip_packages');
    }
};
