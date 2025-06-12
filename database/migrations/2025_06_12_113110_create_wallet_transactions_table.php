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
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wallet_id')->constrained('wallets')->onDelete('cascade');
            $table->enum('transaction_type', ['deposit', 'withdrawal', 'transfer'])->default('deposit'); // Type of transaction
            $table->decimal('amount', 15, 2); // Transaction amount
            $table->string('currency', 10)->default('LKR'); // Currency type, default to LKR
            $table->string('description')->nullable(); // Description of the transaction
            $table->timestamp('transaction_date')->useCurrent(); // Date and time of the transaction
            $table->string('status')->default('completed'); // Status of the transaction (e.g., completed, pending, failed)
            $table->string('reference_id')->nullable(); // Reference ID for the transaction, if applicable
            $table->string('transaction_method')->nullable(); // Method of transaction (e.g., bank transfer, cash, etc.)
            $table->string('transaction_fee')->nullable(); // Transaction fee, if applicable
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallet_transactions');
    }
};
