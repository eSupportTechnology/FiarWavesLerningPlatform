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
        Schema::table('customers', function (Blueprint $table) {
            // ID Information
            $table->enum('id_type', ['NIC', 'DL', 'Passport'])->nullable()->after('contact_number');
            $table->string('id_number')->nullable()->after('id_type');

            // Address (structured)
            $table->string('street')->nullable()->after('id_number');
            $table->string('city')->nullable()->after('street');
            $table->string('district')->nullable()->after('city');
            $table->string('postal_code')->nullable()->after('district');

            // Bank details (structured)
            $table->string('bank_name')->nullable()->after('postal_code');
            $table->string('bank_branch')->nullable()->after('bank_name');
            $table->string('account_name')->nullable()->after('bank_branch');
            $table->string('account_number')->nullable()->after('account_name');
            $table->string('account_type')->nullable()->after('account_number');

            $table->string('invite_code')->nullable()->unique()->after('account_type');
            $table->boolean('is_side_selected')->default(false)->after('invite_code'); // New column to track side selection

            $table->integer('left_side_points')->default(0)->after('is_side_selected');
            $table->integer('right_side_points')->default(0)->after('left_side_points');
            $table->boolean('is_first_time_withdrawal')->default(false)->after('right_child_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            // Drop newly added columns
            $table->dropColumn([
                'id_type',
                'id_number',
                'street',
                'city',
                'district',
                'postal_code',
                'bank_name',
                'bank_branch',
                'account_name',
                'account_number',
                'account_type',
                'invite_code',
                'is_side_selected',
                'left_side_points',
                'right_side_points',
                'is_first_time_withdrawal',
            ]);
        });
    }
};
