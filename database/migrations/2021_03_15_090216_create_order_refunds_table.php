<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderRefundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_refunds', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('order_id');
            $table->foreign('order_id')
                ->references('id')
                ->on('orders');
				
			$table->unsignedBigInteger('order_details_id');
			$table->foreign('order_details_id')
                ->references('id')
                ->on('order_details');
			
			$table->unsignedBigInteger('return_from_id');
			$table->foreign('return_from_id')
                ->references('id')
                ->on('order_cancel_products');
				
			$table->string('table_name',150)->nullable();
			$table->decimal('total_amount')->nullable();
			$table->decimal('refund_amount')->nullable();		
			$table->string('refund_status',50)->nullable();
			$table->string('refund_from',150)->nullable();
			$table->text('refund_token')->nullable();		
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
        Schema::dropIfExists('order_refunds');
    }
}
