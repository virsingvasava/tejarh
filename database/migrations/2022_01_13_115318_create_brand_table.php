<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->unsigned()->index()->nullable();
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');
            $table->bigInteger('sub_category_id')->unsigned()->index()->nullable();
            $table->foreign('sub_category_id')->references('id')->on('sub_category')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('model')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('status')->default('0')->comment('0');
            $table->string('ar_name')->nullable();
            $table->string('ar_model')->nullable();
            $table->string('ar_slug')->nullable();
            $table->boolean('ar_status')->default('0')->comment('0');
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
        Schema::dropIfExists('brands');

    }
}
