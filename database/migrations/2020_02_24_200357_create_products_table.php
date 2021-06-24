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
            $table->bigIncrements('id');
            //$table->unsignedBigInteger('type_id')->default(1);
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('currency_id');
            //$table->unsignedDecimal('quantity',8, 2)->default(null);
            $table->unsignedBigInteger('tax_rate_id');
            $table->boolean('is_tax_included')->default(true);
            $table->unsignedDecimal('selling_price', 8, 2);
            //$table->unsignedDecimal('list_price', 8, 2)->nullable();
            //$table->unsignedDecimal('cost_price', 8, 2)->nullable();
            //$table->unsignedFloat('weight')->nullable();
            //$table->unsignedFloat('width')->nullable();
            //$table->unsignedFloat('length')->nullable();
            //$table->unsignedFloat('height')->nullable();
            //$table->unsignedDecimal('min_selling_quantity', 8, 2)->nullable();
            //$table->unsignedDecimal('max_selling_quantity', 8, 2)->nullable();
            //$table->unsignedBigInteger('supplier_id')->nullable();
            $table->string('sku')->nullable()->unique()->comment('Stock Keeping Unit');
            $table->string('gtin', 14)->nullable()->unique()->comment('Global Trade Item Number');
            $table->string('upc', 12)->nullable()->unique()->comment('Universal Product Code');
            $table->string('ean', 13)->nullable()->unique()->comment('European Article Number');
            $table->string('jan', 13)->nullable()->unique()->comment('Japan Article Number');
            $table->string('isbn', 13)->nullable()->unique()->comment('International Standard Book Number');
            $table->string('itf_14', 14)->nullable()->unique()->comment('Interleaved 2 of 5');
            $table->string('mpn')->nullable()->unique()->comment('Manufacturer Part Number');
            $table->string('oem')->nullable()->unique()->comment('Original Equipment Manufacturer');
            $table->string('non_oem')->nullable()->unique()->comment('non-Original Equipment Manufacturer');
            $table->smallInteger('row')->nullable();
            $table->boolean('is_active')->default(false);
            //$table->unsignedBigInteger('created_by');
            //$table->unsignedBigInteger('updated_by')->nullable();
            //$table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            //$table->foreign('type_id')->references('id')->on('product_types');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->foreign('tax_rate_id')->references('id')->on('tax_rates');
            //$table->foreign('supplier_id')->references('id')->on('suppliers');
            //$table->foreign('created_by')->references('id')->on('users');
            //$table->foreign('updated_by')->references('id')->on('users');
            //$table->foreign('deleted_by')->references('id')->on('users');
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
