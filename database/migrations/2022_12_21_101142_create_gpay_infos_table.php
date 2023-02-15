<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGpayInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gpay_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('amount')->nullable();
            $table->text('token')->nullable();
            $table->string('type')->nullable();
            $table->string('name')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->string('postalCode')->nullable();
            $table->text('address1')->nullable();
            $table->string('administrativeArea')->nullable();
            $table->string('countryCode')->nullable();
            $table->string('locality')->nullable();
            $table->string('shippingOptionData')->nullable();
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
        Schema::dropIfExists('gpay_infos');
    }
}
