<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_inventories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->unique();
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
            $table->integer('initial_qty')->default(0);
            $table->double('unit_price')->nullable();
            $table->double('market_price')->nullable();
            $table->float('purchase_price')->default(0);
            $table->float('sell_price')->default(0);
            $table->decimal('discount')->default(0);
            $table->string('discount_type',50)->nullable();
            $table->decimal('discount_amount',50)->nullable();
            $table->decimal('seller_commission')->default(0);
            $table->string('commission_type',50)->nullable();
            $table->decimal('commission_amount',50)->nullable();
            $table->integer('stock_qty')->default(0);
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
        Schema::dropIfExists('product_inventories');
    }
}
