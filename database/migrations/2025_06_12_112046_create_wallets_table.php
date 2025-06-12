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
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers', 'user_id')->onDelete('cascade');
            $table->decimal('balance', 15, 2)->default(0.00); // Wallet balance
            $table->decimal('total_deposited', 15, 2)->default(0.00); // Total amount deposited
            $table->decimal('total_withdrawn', 15, 2)->default(0.00); // Total amount withdrawn
            $table->enum('status', ['active', 'inactive'])->default('active'); // Wallet status
            $table->string('currency', 10)->default('LKR'); // Currency type, default to USD
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
