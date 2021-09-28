<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller_id');
            $table->foreign('seller_id')
			->references('id')
			->on('merchants');
			$table->unsignedBigInteger('customer_id');
			$table->foreign('customer_id')
			->references('id')
			->on('customers');
			$table->unsignedBigInteger('guest_id');
			$table->foreign('guest_id')
			->references('id')
			->on('guests');			
				
            $table->string('order_number')->nullable();
            $table->decimal('total_price')->nullable();
			$table->string('status')->nullable();
			$table->date('order_date')->nullable();
			$table->date('ship_date')->nullable();
			$table->date('delivery_date')->nullable();     
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
        Schema::dropIfExists('orders');
    }
}
