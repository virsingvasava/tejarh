<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_category', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->unsigned()->index()->nullable();
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');
            $table->string('sub_cate_name')->nullable();
            $table->string('slug')->nullable();
            $table->string('sub_cate_picture');
            $table->boolean('status')->default('0')->comment('0');
            $table->bigInteger('ar_category_id')->unsigned()->index()->nullable();
            $table->foreign('ar_category_id')->references('id')->on('category')->onDelete('cascade');
            $table->string('ar_sub_cate_name')->nullable();
            $table->string('ar_slug')->nullable();
            $table->string('ar_sub_cate_picture')->nullable();
            $table->boolean('ar_status')->default('0')->comment('0');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.ss
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_category');
    }
}
