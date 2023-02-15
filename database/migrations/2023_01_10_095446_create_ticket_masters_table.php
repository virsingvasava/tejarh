<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_masters', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('ticket_user_id')->nullable();
            $table->string('subject')->nullable();
            $table->integer('category')->nullable();
            $table->string('sku_id')->nullable();
            $table->integer('status')->default(FALSE)->comment('open=0','close=1');
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
        Schema::dropIfExists('ticket_masters');
    }
}
