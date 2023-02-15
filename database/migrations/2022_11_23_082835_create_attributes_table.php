<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->nullable();
            $table->Integer('sub_category_id')->nullable();
            $table->string('name')->nullable();
            $table->boolean('status')->default('0')->comment('0');
            $table->string('ar_name')->nullable();
            $table->boolean('ar_status')->default('0')->comment('0');
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
        Schema::dropIfExists('attributes');
    }
}
