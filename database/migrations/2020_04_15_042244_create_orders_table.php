<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('firstname',32);
            $table->string('lastname',32);
            $table->string('email',96);
            $table->string('phone',32);
            $table->string('payment_firstname',32);
            $table->string('payment_lastname',32);
            $table->string('payment_company',60);
            $table->string('payment_city',128);
            $table->string('payment_postcode',10);
            $table->string('payment_country',128);
            $table->text('payment_address');
            $table->string('payment_method',128);
            $table->string('shipping_firstname',32);
            $table->string('shipping_lastname',32);
            $table->string('shipping_city',128);
            $table->string('shipping_postcode',10);
            $table->string('shipping_country',128);
            $table->text('shipping_address');
            $table->string('shipping_method',128);
            $table->text('comment');
            $table->decimal('total',15,4)->default(0.0000);
            $table->bigInteger('order_status_id')->default(1);
            $table->decimal('commission',15,4)->default(0.0000);
            $table->string('tracking');
            $table->bigInteger('language_id')->default(14);
            $table->bigInteger('currency_id')->default(4);
            $table->string('currency_code')->default('RUB');
            $table->decimal('currency_value',15,8)->default(1.00000000);

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
        Schema::dropIfExists('orders');
    }
}
