<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShortBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('short_banners', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('ar_title')->nullable();
            $table->string('short_banners_image')->nullable();
            $table->string('status')->default('0');
            $table->string('ar_status')->default('0');
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
        Schema::dropIfExists('short_banners');
    }
}
