<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('commission',8, 2)->nullable();
            $table->tinyInteger('installment');
            $table->decimal('subtotal', 8, 2);
            $table->decimal('tax', 8, 2);
            $table->decimal('discount', 8, 2);
            $table->decimal('total', 8, 2);
            $table->string('payment_currency');
            $table->decimal('currency_subtotal', 8, 2);
            $table->decimal('currency_tax', 8, 2);
            $table->decimal('currency_total', 8, 2);
            $table->decimal('exchange_rate', 8, 2);
            $table->string('exchange_currency');
            $table->string('reference_no');
            $table->string('shipping_tracking_code')->nullable();
            $table->boolean('is_gift')->nullable();
            $table->unsignedBigInteger('shipping_company_id');
            $table->unsignedBigInteger('shipping_status_id');
            $table->unsignedBigInteger('delivery_country_id');
            $table->unsignedBigInteger('delivery_province_id');
            $table->unsignedBigInteger('delivery_district_id');
            $table->string('delivery_name');
            $table->string('delivery_address');
            $table->string('delivery_telephone');
            $table->string('delivery_zip_code');
            $table->unsignedBigInteger('invoice_country_id');
            $table->unsignedBigInteger('invoice_province_id');
            $table->unsignedBigInteger('invoice_district_id');
            $table->string('invoice_name');
            $table->string('invoice_address');
            $table->string('invoice_telephone');
            $table->string('invoice_zip_code');
            $table->string('invoice_tax_office');
            $table->string('invoice_tax_number');
            $table->unsignedBigInteger('payment_type_id');
            $table->unsignedBigInteger('payment_status_id');
            $table->unsignedBigInteger('order_status_id');
            $table->boolean('is_invoiced')->default(false);
            $table->timestamp('shipping_at')->nullable();
            $table->timestamp('delivery_at')->nullable();
            $table->unsignedBigInteger('payment_status_processed_by');
            $table->unsignedBigInteger('order_status_processed_by');
            $table->unsignedBigInteger('invoiced_by')->nullable();
            $table->unsignedBigInteger('shipped_by')->nullable();
            $table->unsignedBigInteger('delivered_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('shipping_company_id')->references('id')->on('shipping_companies');
            $table->foreign('shipping_status_id')->references('id')->on('shipping_statuses');
            $table->foreign('delivery_country_id')->references('id')->on('countries');
            $table->foreign('delivery_province_id')->references('id')->on('provinces');
            $table->foreign('delivery_district_id')->references('id')->on('districts');
            $table->foreign('invoice_country_id')->references('id')->on('countries');
            $table->foreign('invoice_province_id')->references('id')->on('provinces');
            $table->foreign('invoice_district_id')->references('id')->on('districts');
            $table->foreign('payment_type_id')->references('id')->on('payment_types');
            $table->foreign('payment_status_id')->references('id')->on('payment_statuses');
            $table->foreign('order_status_id')->references('id')->on('order_statuses');
            $table->foreign('payment_status_processed_by')->references('id')->on('users');
            $table->foreign('order_status_processed_by')->references('id')->on('users');
            $table->foreign('invoiced_by')->references('id')->on('users');
            $table->foreign('shipped_by')->references('id')->on('users');
            $table->foreign('delivered_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
