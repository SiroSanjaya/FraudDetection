<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCustomersTableAddNewFields extends Migration
{
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            // Modify the type of 'assigned_to' to BIGINT and allow NULL values
            $table->unsignedBigInteger('assigned_to')->nullable()->change();


            // Add the new foreign key constraint
            $table->foreign('assigned_to')->references('user_id')->on('users')->onDelete('SET NULL');
        });
    }

    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            // Remove added fields
            $table->dropColumn(['last_name', 'farm_type', 'company_name', 'street', 'city', 'state', 'zip_code', 'country', 'date_of_birth', 'customer_since', 'last_purchase_date', 'total_spent', 'loyalty_tier', 'notes', 'assigned_to']);
            // If you've added foreign keys or indexes, drop those here as well
            $table->dropForeign(['assigned_to']);
        });
    }
}
