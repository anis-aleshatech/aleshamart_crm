<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
			$table->unsignedBigInteger('seller_id');
            $table->foreign('seller_id')->references('id')->on('merchants');
			$table->unsignedBigInteger('customer_id');
			$table->foreign('customer_id')->references('id')->on('customers');
			$table->unsignedBigInteger('guest_id');
			$table->foreign('guest_id')->references('id')->on('guests');
			$table->unsignedBigInteger('shipping_id');
			$table->foreign('shipping_id')->references('id')->on('shippings');
			$table->unsignedBigInteger('product_id');
			$table->foreign('product_id')->references('id')->on('products');	           
		    $table->integer('qty')->nullable();
			$table->string('saleprice')->nullable();
			$table->string('pcolor')->nullable();
			$table->string('psize')->nullable();
			$table->string('subtotal')->nullable();
			$table->string('shipping_charge')->nullable();
			$table->string('taxprice')->nullable();
			$table->string('giftprice')->nullable();
			$table->string('status')->nullable();
			$table->string('payment_method')->nullable();
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
        Schema::dropIfExists('order_details');
    }
}
