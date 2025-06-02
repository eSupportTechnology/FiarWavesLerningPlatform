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
        Schema::create('vip_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Link to customers table
            $table->unsignedBigInteger('vip_package_id'); // Link to VIP package
            $table->enum('payment_method', ['Card', 'Bank Transfer']);
            $table->string('receipt')->nullable(); // For bank transfers
            $table->string('bank_name')->nullable();
            $table->string('bank_branch')->nullable();
            $table->date('transfer_date')->nullable();
            $table->enum('status', ['Pending', 'Confirmed'])->default('Pending');
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('user_id')->on('customers')->onDelete('cascade');
            $table->foreign('vip_package_id')->references('id')->on('vip_packages')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vip_bookings');
    }
};
