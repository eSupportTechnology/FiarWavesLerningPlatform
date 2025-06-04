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
        Schema::create('customers', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');

            $table->string('address')->nullable();
            $table->string('contact_number')->unique();

            $table->boolean('is_verified')->default(false); // After SMS verification
            $table->string('verification_code')->nullable(); // SMS OTP

            $table->string('stu_id')->unique()->nullable(); // Student ID assigned by admin
            $table->foreignId('batch_id')->nullable()->constrained('batches')->nullOnDelete();

            $table->boolean('status')->default(false); // 0 = inactive, 1 = active
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
