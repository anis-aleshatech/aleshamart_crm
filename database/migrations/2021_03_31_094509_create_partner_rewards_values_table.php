<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerRewardsValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_rewards_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rewards_category_id');
            $table->foreign('rewards_category_id')
                ->references('id')
                ->on('rewards_categories');
            $table->unsignedBigInteger('partner_id');
            $table->foreign('partner_id')
                ->references('id')
                ->on('partner_manages');
            $table->float('reward_points')->default(0);
            $table->float('price_value')->default(0);
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
        Schema::dropIfExists('partner_rewards_values');
    }
}
