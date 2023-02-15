<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreDistancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_distances', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('item_id')->nullable();
            $table->integer('store_id')->nullable();
            $table->string('user_latitude')->nullable();
            $table->string('user_longitude')->nullable();
            $table->string('store_latitude')->nullable();
            $table->string('store_longitude')->nullable();
            $table->string('distance')->nullable();
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
        Schema::dropIfExists('store_distances');
    }
}
