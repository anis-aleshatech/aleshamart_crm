<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userid');
            $table->foreign('userid')
                ->references('id')
                ->on('customers')
                ->onDelete('cascade');
            $table->unsignedBigInteger('blog_cat_id');
            $table->foreign('blog_cat_id')
                ->references('id')
                ->on('blog_categories')
                ->onDelete('cascade');
            $table->string('headline',250)->nullable();
            $table->string('slug',250)->nullable();
            $table->string('video',50)->nullable();
            $table->mediumText('description')->nullable();
            $table->string('image',250)->nullable();
            $table->string('postby',150)->nullable();
            $table->date('publishdate')->nullable();
            $table->integer('read_count')->nullable();
            $table->integer('sequence')->nullable();
            $table->integer('hotblog')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->string('meta_description',250)->nullable();
            $table->string('keywords',250)->nullable();
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
        Schema::dropIfExists('blogs');
    }
}
