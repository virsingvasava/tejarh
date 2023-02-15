<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_offers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('product_id')->unsigned()->index()->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->bigInteger('category_id')->unsigned()->index()->nullable();
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');
            $table->bigInteger('sub_category_id')->unsigned()->index()->nullable();
            $table->foreign('sub_category_id')->references('id')->on('sub_category')->onDelete('cascade');
            $table->integer('customer_id')->nullable();
            $table->string('card_type')->nullable();
            $table->integer('discount_value')->nullable();
            $table->string('discount_unit')->nullable();
            $table->string('valid_from')->nullable();
            $table->string('valid_until')->nullable();
            $table->string('coupon_code')->nullable();
            $table->integer('maximum_discount_amount')->nullable();
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
        Schema::dropIfExists('payment_offers');
    }
}
