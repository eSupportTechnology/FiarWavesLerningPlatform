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
            // Add new columns
            $table->string('fname')->after('name');
            $table->string('lname')->after('fname');
            $table->unsignedBigInteger('sponsor_id')->nullable()->after('password');
            $table->unsignedBigInteger('left_child_id')->nullable()->after('sponsor_id');
            $table->unsignedBigInteger('right_child_id')->nullable()->after('left_child_id');

            // Make contact_number nullable (assume it's unique now)
            // First, try to drop unique index using the actual name
            // try {
            //     $table->dropUnique('contact_number'); // If Laravel named it like this
            // } catch (\Throwable $e) {
            //     // fallback: ignore if it doesn't exist
            // }

            // Then, change the column to nullable
            $table->string('contact_number')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            // Rename back 'fname' to 'name'
            $table->renameColumn('fname', 'name');

            // Drop added columns
            $table->dropColumn(['lname', 'sponsor_id', 'left_child_id', 'right_child_id']);

            // Revert contact_number back to unique and not nullable
            $table->string('contact_number')->nullable(false)->change();
            $table->unique('contact_number');
        });
    }
};
