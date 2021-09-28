<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderCancelProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_cancel_products', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('order_id');
            $table->foreign('order_id')
                ->references('id')
                ->on('orders');
				
			$table->unsignedBigInteger('order_details_id');
			$table->foreign('order_details_id')
                ->references('id')
                ->on('order_details');
				
			$table->unsignedBigInteger('seller_id');
			$table->foreign('seller_id')->references('id')->on('merchants');
			
			$table->unsignedBigInteger('customer_id');
			$table->foreign('customer_id')->references('id')->on('customers');
			
			$table->unsignedBigInteger('cancel_id');
			$table->foreign('cancel_id')
                ->references('id')
                ->on('order_cancel_requests');
				
			$table->string('status',50)->nullable();
			$table->integer('refunded')->nullable();
			$table->string('table_name',150)->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();			
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_cancel_products');
    }
}
