<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('model');
            $table->tinyInteger('media_type'); //Resim, Doküman, Video,
            $table->string('source');
            $table->tinyInteger('order')->nullable();
            $table->tinyInteger('item_type')->nullable(); //Resim tipi için cover | other
            $table->json('content')->nullable(); //Döküman için başlık
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medias');
    }
}
