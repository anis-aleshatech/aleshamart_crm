<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_requests', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('customer_id');
			$table->foreign('customer_id')->references('id')->on('customers'); 
			$table->string('accounts',150)->nullable(); 
			$table->string('request_method',150)->nullable(); 
			$table->decimal('current_balance')->nullable(); 
			$table->decimal('amount')->nullable(); 
			$table->decimal('paid_amount')->nullable();
			$table->date('paid_date')->nullable();
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
        Schema::dropIfExists('payment_requests');
    }
}
