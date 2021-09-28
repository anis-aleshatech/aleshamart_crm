<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_offers', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('seller_id');
            $table->foreign('seller_id')
			->references('id')
			->on('merchants');
            $table->string('url',150)->nullable();
            $table->string('slug',150)->nullable();
            $table->string('name',150)->nullable();
            $table->string('image',150)->nullable();
            $table->text('meta_details')->nullable();
            $table->string('keywords',200)->nullable();
            $table->integer('sequence')->nullable();
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
        Schema::dropIfExists('special_offers');
    }
}
