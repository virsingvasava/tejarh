<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckOutUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_out_user_details', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('item_id')->nullable();
            $table->string('address_id')->nullable();
            $table->boolean('status')->comment('default=0')->default('0');
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
        Schema::dropIfExists('check_out_user_details');
    }
}
