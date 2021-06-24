<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockUnitTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_unit_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('stock_unit_id');
            $table->string('locale')->index();
            $table->string('name');

            $table->unique(['stock_unit_id', 'locale']);
            $table->foreign('stock_unit_id')->references('id')->on('stock_units')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_unit_translations');
    }
}
