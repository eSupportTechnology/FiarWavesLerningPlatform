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
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id'); // Foreign key to Customer
            $table->decimal('amount', 10, 2);
            $table->string('bank_name');
            $table->string('bank_branch')->nullable();
            $table->string('account_name');
            $table->string('account_number');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->decimal('left_points_used', 8, 2)->default(0);
            $table->decimal('right_points_used', 8, 2)->default(0);
            $table->date('withdrawal_date')->nullable();
            $table->time('withdrawal_time')->nullable();
            $table->enum('withdrawal_type', ['first_time', 'subsequent'])->default('first_time');
            $table->timestamps();

            $table->foreign('customer_id')
                ->references('user_id') // Assuming user_id is primary in customers
                ->on('customers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdrawals');
    }
};
