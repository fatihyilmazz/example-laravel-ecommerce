<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('english_name');
            $table->string('native_name');
            $table->string('script');
            $table->string('regional');
            $table->smallInteger('order')->nullable();
            $table->boolean('is_default_for_admin')->default(false);
            $table->boolean('is_default_for_customer')->default(false);
            $table->boolean('is_usable_for_users')->default(false);
            $table->boolean('is_active')->default(false);
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
        Schema::dropIfExists('locales');
    }
}
