<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingDeliveryCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_delivery_companies', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('item_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->string('serviceType')->nullable();
            $table->string('deliveryOptionName')->nullable();
            $table->string('trackingType')->nullable();
            $table->integer('codCharge')->nullable();
            $table->integer('maxOrderValue')->nullable();
            $table->string('insurancePolicy')->nullable();
            $table->integer('deliveryOptionId')->nullable();
            $table->integer('extraWeightPerKg')->nullable();
            $table->string('deliveryCompanyName')->nullable();
            $table->string('pickupCutoffTime')->nullable();
            $table->string('avgDeliveryTime')->nullable();
            $table->integer('returnFee')->nullable();
            $table->integer('maxFreeWeight')->nullable();
            $table->string('price')->nullable();
            $table->longText('logo')->nullable();
            $table->string('pickupDropoff')->nullable();
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
        Schema::dropIfExists('shipping_delivery_companies');
    }
}
