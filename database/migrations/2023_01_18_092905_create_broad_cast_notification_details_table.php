<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBroadCastNotificationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('broad_cast_notification_details', function (Blueprint $table) {
            $table->id();
            $table->integer('broadcast_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('notification_title')->nullable();
            $table->string('notification_message')->nullable();
            $table->integer('status')->default('0')->comment('unread = 0','read = 1');
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
        Schema::dropIfExists('broad_cast_notification_details');
    }
}
