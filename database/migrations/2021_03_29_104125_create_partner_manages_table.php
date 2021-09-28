<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerManagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_manages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rewards_category_id');
            $table->foreign('rewards_category_id')
                ->references('id')
                ->on('rewards_categories');
            $table->string('partner_name',250)->nullable();
            $table->string('partner_logo',150)->nullable();
            $table->tinyInteger('status')->nullable();
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
        Schema::dropIfExists('partner_manages');
    }
}
