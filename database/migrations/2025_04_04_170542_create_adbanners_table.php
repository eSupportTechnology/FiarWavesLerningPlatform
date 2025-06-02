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
        Schema::create('adbanners', function (Blueprint $table) {
            $table->id();
            $table->string('image'); // Path to the uploaded image
            $table->string('caption')->nullable(); // Optional promo text
            $table->boolean('status')->default(true); // Active or not
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adbanners');
    }
};
