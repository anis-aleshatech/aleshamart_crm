<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();
            $table->string('name',150)->nullable();
            $table->string('businessname',100)->nullable();
            $table->string('businesstype',50)->nullable();
            $table->text('aboutseller')->nullable();
            $table->string('username',100)->unique()->nullable();
            $table->string('ownername',100)->nullable();
            $table->string('photo',250)->nullable();
            $table->string('logo',250)->nullable();
            $table->text('address')->nullable();
            $table->text('address2')->nullable();
            $table->unsignedBigInteger('division_id');
            $table->foreign('division_id')
                ->references('id')
                ->on('divisions');
            $table->unsignedBigInteger('district_id');
            $table->foreign('district_id')
                ->references('id')
                ->on('districts');
            $table->unsignedBigInteger('area_id');
            $table->foreign('area_id')
                ->references('id')
                ->on('areas');
            $table->string('zipcode',50)->nullable();
            $table->string('language',50)->nullable();
            $table->string('telephone',15)->nullable();
            $table->string('mobile',15)->unique()->nullable();
            $table->string('email',50)->unique()->nullable();
            $table->string('alternate_email',50)->nullable();
            $table->string('password',200)->nullable();
            $table->string('device',150)->nullable();
            $table->string('device_token',150)->nullable();
            $table->string('website',50)->nullable();
            $table->tinyInteger('otpverify')->nullable();
            $table->tinyInteger('agreement_complete')->nullable();
            $table->tinyInteger('business_complete')->nullable();
            $table->tinyInteger('payment_complete')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->string('member_type')->nullable();
            $table->integer('default_tax_code')->nullable();
            $table->tinyInteger('agreement')->nullable();
            $table->rememberToken();
            $table->tinyInteger('store_preset')->nullable();
            $table->text('facebook')->nullable();
            $table->text('twitter')->nullable();
            $table->text('youtube')->nullable();
            $table->text('instagram')->nullable();
            $table->text('pinterest')->nullable();
            $table->text('linkedin')->nullable();
            $table->string('meta_title',250)->nullable();
            $table->text('meta_details')->nullable();
            $table->text('keywords')->nullable();
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
        Schema::dropIfExists('merchants');
    }
}
