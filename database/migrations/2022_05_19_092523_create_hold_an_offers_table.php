<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoldAnOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hold_an_offers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('buyer_id')->unsigned()->index()->nullable();
            $table->foreign('buyer_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('seller_id')->unsigned()->index()->nullable();
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('item_id')->unsigned()->index()->nullable();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->string('item_price')->nullable();
            $table->string('booking_price')->nullable();
            $table->string('payable_amount')->nullable();
            $table->boolean('status')->comment('default=0')->default('0');
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
        Schema::dropIfExists('hold_an_offers');
    }
}
