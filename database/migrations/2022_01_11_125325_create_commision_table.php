<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommisionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commision', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->string('name')->nullable();
            $table->string('user_type')->nullable();
            $table->boolean('status')->default('0')->comment('0');
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
        Schema::dropIfExists('commision');
    }
}
