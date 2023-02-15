<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDeliveryCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_delivery_companies', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->nullable();
            $table->integer('item_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->string('delivery_option_id')->nullable();
            $table->string('otoid')->nullable();
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
        Schema::dropIfExists('order_delivery_companies');
    }
}
