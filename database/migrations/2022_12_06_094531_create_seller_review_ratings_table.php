<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerReviewRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_review_ratings', function (Blueprint $table) {
            $table->id();
            $table->string('seller_id')->nullable();
            $table->string('user_id')->nullable();
            $table->integer('rating_star')->nullable();
            $table->string('review_description')->nullable();
            $table->string('review_picture')->nullable();
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
        Schema::dropIfExists('seller_review_ratings');
    }
}
