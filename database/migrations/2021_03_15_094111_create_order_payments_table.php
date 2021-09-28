<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_payments', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('order_id');
            $table->foreign('order_id')
                ->references('id')
                ->on('orders');
			$table->unsignedBigInteger('customer_id');
			$table->foreign('customer_id')->references('id')->on('customers');
			$table->unsignedBigInteger('guest_id');
			$table->foreign('guest_id')->references('id')->on('guests');
			$table->unsignedBigInteger('shipping_id');
			$table->foreign('shipping_id')->references('id')->on('shippings');
			$table->unsignedBigInteger('seller_id');
            $table->foreign('seller_id')->references('id')->on('merchants');
			
			$table->string('before_tax')->nullable();
			$table->string('estimate_tax')->nullable();
			$table->string('gift_value')->nullable();
			$table->string('total_amount')->nullable();
			$table->string('paid_amount')->nullable();
			$table->string('due_amount')->nullable();
			$table->string('discount')->nullable();
			$table->string('payment_method')->nullable();
            $table->string('mobile_banking_id')->nullable();
			$table->string('transition_id')->nullable();
			$table->string('card_name')->nullable();
			$table->string('card_number')->nullable();
			$table->string('month')->nullable();
			$table->string('year')->nullable();
			$table->text('remarks')->nullable();
			$table->string('shipping_charge')->nullable();			
			$table->date('ship_date')->nullable();			
			$table->date('delivery_date')->nullable();
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
        Schema::dropIfExists('order_payments');
    }
}
