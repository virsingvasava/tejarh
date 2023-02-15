<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('heading_title')->nullable();
            $table->string('subject')->nullable();
            $table->longText('body_message')->nullable();
            $table->string('email_send_status')->nullable();
            $table->boolean('after_subscribed_send_message_status')->default('0')->comment('default=0');
            $table->boolean('status')->default('0')->comment('default=0');
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
        Schema::dropIfExists('subscriptions');
    }
}
