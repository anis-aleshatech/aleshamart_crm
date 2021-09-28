<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_menus', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('seller_id');
            $table->foreign('seller_id')
			->references('id')
			->on('merchants');
            $table->integer('parent_id')->nullable();
            $table->string('title',150)->nullable();
            $table->string('uri',150)->nullable();
            $table->tinyInteger('status')->nullable();
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
        Schema::dropIfExists('seller_menus');
    }
}
