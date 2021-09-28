<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_contents', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('seller_id');
            $table->foreign('seller_id')
			->references('id')
			->on('merchants');
			$table->unsignedBigInteger('menu_id');
            $table->foreign('menu_id')
			->references('id')
			->on('seller_menus');			
            $table->string('title',150)->nullable();
            $table->text('content')->nullable();
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
        Schema::dropIfExists('seller_contents');
    }
}
