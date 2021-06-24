<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditCardInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_card_installments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('credit_card_id');
            $table->decimal('min_price', 8,2)->nullable();
            $table->decimal('max_price', 8,2)->nullable();
            $table->tinyInteger('installment');
            $table->decimal('commission',8, 2)->nullable();
            $table->unsignedBigInteger('gateway_id');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('credit_card_id')->references('id')->on('credit_cards')->onDelete('cascade');
            $table->foreign('gateway_id')->references('id')->on('credit_card_gateways')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credit_card_installments');
    }
}
