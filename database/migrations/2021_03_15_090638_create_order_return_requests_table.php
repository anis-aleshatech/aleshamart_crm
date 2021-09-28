<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderReturnRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_return_requests', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
			$table->unsignedBigInteger('order_details_id');
			$table->foreign('order_details_id')
                ->references('id')
                ->on('order_details');
			$table->unsignedBigInteger('customer_id');
			$table->foreign('customer_id')->references('id')->on('customers');
			$table->unsignedBigInteger('order_product_id');
			$table->foreign('order_product_id')->references('id')->on('products');
			$table->unsignedBigInteger('exchangeproduct');
			$table->foreign('exchangeproduct')->references('id')->on('products');	           
		    $table->string('return_type')->nullable();
			$table->integer('return_causes')->nullable();
			$table->integer('refunded')->nullable();
			$table->text('remarks')->nullable();
			$table->string('table_name')->nullable();
			$table->string('paymentmethod')->nullable();
			$table->string('account_name')->nullable();
			$table->string('account_number')->nullable();
			$table->string('total_amount')->nullable();
			$table->string('status')->nullable();
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
        Schema::dropIfExists('order_return_requests');
    }
}
