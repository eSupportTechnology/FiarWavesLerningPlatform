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
            $table->enum('kyc_doc_type', ['NIC', 'DL', 'Passport'])->nullable()->after('contact_number');
            $table->string('kyc_doc_number')->nullable()->after('kyc_doc_type');

            // Address (structured)
            $table->string('street')->nullable()->after('kyc_doc_number');
            $table->string('city')->nullable()->after('street');
            $table->string('district')->nullable()->after('city');
            $table->string('postal_code')->nullable()->after('district');

            // Bank details (structured)
            $table->string('bank_name')->nullable()->after('postal_code');
            $table->string('bank_branch')->nullable()->after('bank_name');
            $table->string('account_name')->nullable()->after('bank_branch');
            $table->string('account_number')->nullable()->after('account_name');
            $table->string('account_type')->nullable()->after('account_number');
            $table->string('bank_front_image')->nullable()->after('account_type'); // New column for bank front image
            $table->string('bank_back_image')->nullable()->after('bank_front_image'); // New column for bank back image
            $table->enum('bank_status', ['pending', 'approved', 'rejected'])->nullable()->after('bank_back_image'); // New column for bank status


            $table->string('invite_code')->nullable()->unique()->after('account_type');
            $table->boolean('is_side_selected')->default(false)->after('invite_code'); // New column to track side selection

            $table->integer('left_side_points')->default(0)->after('is_side_selected');
            $table->integer('right_side_points')->default(0)->after('left_side_points');
            $table->boolean('is_first_time_withdrawal')->default(false)->after('right_child_id');

            // Add new columns for front and back images
            $table->string('kyc_doc_front')->nullable()->after('kyc_doc_number');
            $table->string('kyc_doc_back')->nullable()->after('kyc_doc_front');
            $table->enum('kyc_status', ['pending', 'approved', 'rejected'])->nullable()->after('kyc_doc_back');

            $table->integer('total_left_points')->default(0)->after('right_child_id');
            $table->integer('total_right_points')->default(0)->after('total_left_points');

            $table->integer('active_left_points')->default(0)->after('total_right_points');
            $table->integer('active_right_points')->default(0)->after('active_left_points');

            $table->integer('used_left_points')->default(0)->after('active_right_points');
            $table->integer('used_right_points')->default(0)->after('used_left_points');
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
                'kyc_doc_type',
                'kyc_doc_number',
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
                'kyc_doc_front',
                'kyc_doc_back',
                'kyc_status',
                'total_left_points',
                'total_right_points',
                'active_left_points',
                'active_right_points',
                'used_left_points',
                'used_right_points',
                'bank_front_image',
                'bank_back_image',
                'bank_status',
            ]);
        });
    }
};
