<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFisheryFieldsToLeadsAndCustomers extends Migration
{
    public function up()
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->string('fishery_address')->nullable();
            $table->decimal('fishery_lat', 10, 7)->nullable();
            $table->decimal('fishery_lng', 10, 7)->nullable();
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->string('fishery_address')->nullable();
            $table->decimal('fishery_lat', 10, 7)->nullable();
            $table->decimal('fishery_lng', 10, 7)->nullable();
        });
    }

    public function down()
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn(['fishery_address', 'fishery_lat', 'fishery_lng']);
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn(['fishery_address', 'fishery_lat', 'fishery_lng']);
        });
    }
}
