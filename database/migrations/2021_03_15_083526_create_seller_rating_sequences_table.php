<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerRatingSequencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_rating_sequences', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('seller_id');
            $table->foreign('seller_id')
			->references('id')
			->on('merchants');
			
			$table->unsignedBigInteger('order_id');
            $table->foreign('order_id')
			->references('id')
			->on('orders');
            $table->integer('shipping_ontime')->nullable();
            $table->integer('order_cancellations')->nullable();
			$table->integer('response')->nullable();
			$table->integer('customer_inquiries')->nullable();
			$table->integer('product_quality')->nullable();
			$table->integer('positive_feedback')->nullable();
			$table->integer('a2z_claims_nagative')->nullable();
			$table->integer('a2z_claims_positive')->nullable();
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
        Schema::dropIfExists('seller_rating_sequences');
    }
}
