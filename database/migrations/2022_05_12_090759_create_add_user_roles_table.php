<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_user_roles', function (Blueprint $table) {
            $table->id();
            $table->string('user_name')->nullable();
            $table->string('store_name')->nullable();
            $table->bigInteger('branch_id')->unsigned()->index()->nullable();
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->string('phone_code')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('gender')->nullable();
            $table->bigInteger('role_id')->nullable();
            $table->bigInteger('role')->nullable();
            $table->string('role_user_profile_picture')->nullable();
            $table->string('user_auto_generate_id')->nullable();
            $table->boolean('status')->comment('default=0')->default('0');
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
        Schema::dropIfExists('add_user_roles');
    }
}
