<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('banner_heading_title')->nullable();
            $table->string('banner_sub_heading_title')->nullable();
            $table->string('banner_description')->nullable();
            $table->string('banner_picture')->nullable();
            $table->boolean('status')->default('0')->comment('0');
            $table->string('ar_banner_heading_title')->nullable();
            $table->string('ar_banner_sub_heading_title')->nullable();
            $table->string('ar_banner_description')->nullable();
            $table->string('ar_banner_picture')->nullable();
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
        Schema::dropIfExists('sliders');
    }
}
