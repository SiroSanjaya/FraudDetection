<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('DeliveryOrders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sales_order_id')->constrained('SalesOrders')->onDelete('cascade')->onUpdate('cascade');
            // Correctly referencing user_id in the users table
            $table->BigInteger('driver_id');
            $table->foreign('driver_id')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->date('scheduled_date');
            $table->string('delivery_status');
            $table->string('received_by')->nullable();
            $table->text('delivery_address');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('delivery_orders');
    }
}
