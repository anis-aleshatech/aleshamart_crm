<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name',250)->nullable();
            $table->string('alternate',250)->nullable();
            $table->string('slug',250)->nullable();
            $table->string('seotitle',200)->nullable();
            $table->text('details')->nullable();
            $table->string('keywords',250)->nullable();
            $table->string('thumb',250)->nullable();
            $table->string('banner',250)->nullable();
            $table->integer('sequence')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->integer('mainmenu')->nullable();
            $table->string('category_type',150)->nullable();
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
        Schema::dropIfExists('categories');
    }
}
