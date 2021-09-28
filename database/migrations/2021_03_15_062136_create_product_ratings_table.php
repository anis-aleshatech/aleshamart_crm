<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pro_id');
            $table->foreign('pro_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('customers')
                ->onDelete('cascade');
            $table->unsignedBigInteger('username');
            $table->foreign('username')
                ->references('id')
                ->on('customers')
                ->onDelete('cascade');
            $table->unsignedBigInteger('email');
            $table->foreign('email')
                ->references('id')
                ->on('customers')
                ->onDelete('cascade');
            $table->integer('ratval')->nullable();
            $table->text('review')->nullable();
            $table->string('review_title',250)->nullable();
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
        Schema::dropIfExists('product_ratings');
    }
}
