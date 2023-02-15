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
            $table->id();
            $table->string('user_id')->nullable();
            $table->integer('item_id')->nullable();
            $table->integer('store_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('return_order_id')->nullable();
            $table->string('order_number')->nullable();
            $table->float('grand_total')->nullable();
            $table->string('quantity')->nullable();
            $table->integer('item_count')->nullable();
            $table->boolean('is_paid')->default(false);
            $table->string('payment_method')->nullable();
            $table->string('notes')->nullable();
            $table->boolean('payment_status')->comment('default=0')->default('0');
            $table->string('order_status')->comment('default=0 ', 'processing = 1', 'dispatch = 2' , 'cancel = 3' , 'delivered = 4', 'return = 5')->default('0');
            $table->decimal('item_price')->nullable();
            $table->integer('sell_tax')->nullable();
            $table->decimal('shipping_charge')->nullable();
            $table->decimal('discount_amount')->nullable();
            $table->decimal('payable_amount')->nullable();            
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
        Schema::dropIfExists('orders');
    }
}
