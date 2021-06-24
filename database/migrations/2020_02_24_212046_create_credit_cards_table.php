<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bin_number');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('association_id');
            $table->unsignedBigInteger('bank_id');
            $table->unsignedBigInteger('family_id');
            $table->boolean('is_commercial')->default(false);
            $table->boolean('is_active')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('type_id')->references('id')->on('card_types')->onDelete('cascade');
            $table->foreign('association_id')->references('id')->on('card_associations')->onDelete('cascade');
            $table->foreign('bank_id')->references('id')->on('card_banks')->onDelete('cascade');
            $table->foreign('family_id')->references('id')->on('card_families')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credit_cards');
    }
}
