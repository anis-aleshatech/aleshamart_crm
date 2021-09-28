<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentConfirmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_confirms', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('seller_id');
            $table->foreign('seller_id')
			->references('id')
			->on('merchants');
			$table->unsignedBigInteger('order_id');
            $table->foreign('order_id')
			->references('id')
			->on('orders');
            $table->date('ship_date')->nullable();
            $table->string('shipping_method',150)->nullable();
            $table->string('courier',150)->nullable();
            $table->string('shipping_service',150)->nullable();
            $table->string('tracking_id',150)->nullable();
            $table->text('hyperlinks')->nullable();
            $table->string('status',50)->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipment_confirms');
    }
}
