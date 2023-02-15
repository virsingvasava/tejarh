<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->integer('business_id')->nullable();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('category_id')->unsigned()->index()->nullable();
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');
            $table->bigInteger('sub_category_id')->unsigned()->index()->nullable();
            $table->foreign('sub_category_id')->references('id')->on('sub_category')->onDelete('cascade');
            $table->bigInteger('brand_id')->unsigned()->index()->nullable();
            $table->foreign('brand_id')->references('id')->on('brand')->onDelete('cascade');
            $table->bigInteger('condition_id')->unsigned()->index()->nullable();
            $table->foreign('condition_id')->references('id')->on('conditions')->onDelete('cascade');
            $table->bigInteger('store_id')->unsigned()->index()->nullable();
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->bigInteger('store_type_id')->nullable();
            $table->bigInteger('ship_mode_id')->nullable();
            $table->string('attributes')->nullable();
            $table->mediumtext('choice_options')->nullable();
            $table->string('name')->nullable();
            $table->string('size')->nullable();
            $table->string('what_are_you_selling')->nullable();
            $table->string('describe_your_items')->nullable();
            $table->string('weight')->nullable();
            $table->integer('width')->nullable();
            $table->integer('length')->nullable();
            $table->integer('height')->nullable();
            $table->string('condition')->nullable();
            $table->string('quantity')->nullable();
            $table->boolean('stock_plus_or_minus')->default('0');
            $table->longText('address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('ship_mode')->nullable();
            $table->string('pay_shipping')->nullable();
            $table->string('price_type')->nullable();
            $table->bigInteger('price')->nullable();
            $table->string('delivery_type')->nullable();
            $table->string('import_data_status')->nullable();
            $table->float('commission_charge')->nullable();
            $table->float('shipping_charge')->nullable();
            $table->float('total_amount')->nullable();
            $table->string('sku')->index()->nullable();
            $table->boolean('status')->default('0')->comment('default=0');
            $table->boolean('item_upload_status')->default('0');
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
        Schema::dropIfExists('items');
    }
}
