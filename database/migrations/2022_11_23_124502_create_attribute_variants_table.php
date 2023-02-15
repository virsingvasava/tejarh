<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_variants', function (Blueprint $table) {
            $table->id();
            $table->Integer('attribute_id')->nullable();
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
        Schema::dropIfExists('attribute_variants');
    }
}
