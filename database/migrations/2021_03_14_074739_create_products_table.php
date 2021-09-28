<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller_id');
            $table->foreign('seller_id')
                ->references('id')
                ->on('merchants');
            $table->unsignedBigInteger('cat_id');
            $table->foreign('cat_id')
                ->references('id')
                ->on('categories');
            $table->unsignedBigInteger('subcat_id');
            $table->foreign('subcat_id')
                ->references('id')
                ->on('subcategories');
            $table->unsignedBigInteger('subsubcat_id');
            $table->foreign('subsubcat_id')
                ->references('id')
                ->on('subsubcategories');
            $table->unsignedBigInteger('lastcat_id');
            $table->foreign('lastcat_id')
                ->references('id')
                ->on('lastcategories');
          $table->integer('parent_id')->nullable();
          $table->string('productType',50)->nullable()->comment('Retail, Wholesale');
          $table->integer('minQty')->default(0);
          $table->text('name')->nullable();
          $table->text('slug')->nullable();
          $table->string('mainimage')->nullable();
          $table->string('caption',100)->nullable();
          $table->string('code',50)->unique()->nullable();
          $table->integer('product_tax_code')->nullable();
          $table->string('product_id_type',20)->nullable();
          $table->string('sku',50)->nullable();
          $table->string('conditions',50)->nullable();
          $table->string('brand',100)->nullable();
          $table->string('manufacturer',100)->nullable();
          $table->string('manufacturer_part_number',100)->nullable();
          $table->text('features')->nullable()->comment('short description');
          $table->longText('details')->nullable()->comment('long description');
          $table->longText('additional_details')->nullable();
          $table->string('sizes',100)->nullable();
          $table->string('colors',100)->nullable();
          $table->integer('sequence')->default(0);
          $table->tinyInteger('status')->default(0);
          $table->string('comparable',50)->default(0)->comment('0=No, 1=yes');
          $table->string('compareItems',50)->nullable();
          $table->integer('read_count')->default(0);
          $table->string('item_weight',50)->nullable();
          $table->string('item_weight_unit',50)->nullable();
          $table->string('package_weight',50)->nullable();
          $table->string('package_weight_unit',50)->nullable();
          $table->string('dimensions_length',50)->nullable();
          $table->string('dimensions_width',50)->nullable();
          $table->string('dimensions_height',50)->nullable();
          $table->string('warranty',50)->nullable();
          $table->string('warranty_type',50)->nullable();
          $table->string('warranty_duration',50)->nullable();
          $table->string('package_dimension_length',50)->nullable();
          $table->string('package_dimension_width',50)->nullable();
          $table->string('package_dimension_height',50)->nullable();
          $table->string('key_target_audiance',100)->nullable();
          $table->text('meta_description')->nullable();
          $table->text('keywords')->nullable();
          $table->string('tag',100)->nullable();
          $table->integer('giftreceipt')->nullable();
          $table->integer('giftwrapped')->nullable();
          $table->string('gift_wrap_name',50)->nullable();
          $table->string('wrapping_cost',50)->nullable();
          $table->tinyInteger('free_shipping')->nullable()->comment('1=Yes, 0=No');
          $table->tinyInteger('feature')->nullable()->comment('1=Yes, 0=No');
          $table->date('entry_date')->nullable();
          $table->integer('created_by')->nullable();
          $table->string('entry_from',50)->nullable();
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
        Schema::dropIfExists('products');
    }
}
