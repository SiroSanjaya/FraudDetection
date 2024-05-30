<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeOrderIdNullableInItemNew extends Migration
{
    public function up()
    {
        Schema::table('item_new', function (Blueprint $table) {
            $table->string('order_id')->nullable()->change(); // Make order_id nullable
        });
    }

    public function down()
    {
        Schema::table('item_new', function (Blueprint $table) {
            $table->string('order_id')->nullable(false)->change(); // Revert order_id to not nullable
        });
    }
}
