<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('menu_group_id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('menu_type_id')->nullable();
            $table->string('value')->nullable();
            $table->smallInteger('row')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('menu_group_id')->references('id')->on('menu_groups')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('menus')->onDelete('cascade');
            $table->foreign('menu_type_id')->references('id')->on('menu_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
