<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('item_id')->nullable();
            $table->float('price')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('shipping_price')->nullable();
            $table->boolean('status')->comment('default=0 ', 'processing = 1', 'dispatch = 2' , 'cancel = 3' , 'delivered = 4', 'return = 5')->default('0');
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
        Schema::dropIfExists('order_items');
    }
}
