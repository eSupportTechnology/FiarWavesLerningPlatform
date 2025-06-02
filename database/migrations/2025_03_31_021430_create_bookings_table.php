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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers', 'user_id')->onDelete('cascade');
            $table->foreignId('course_id')->constrained('courses', 'course_id')->onDelete('cascade');

            // Payment related
            $table->enum('payment_status', ['half', 'full'])->default('half');
            $table->enum('payment_method', ['Card', 'Bank Transfer']);
            $table->string('receipt_path')->nullable(); // if bank transfer
            $table->string('bank_name')->nullable();
            $table->string('bank_branch')->nullable();
            $table->date('transfer_date')->nullable();

            // Admin + system
            $table->enum('status', ['Pending', 'Confirmed', 'Cancelled'])->default('Pending');
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
