<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('company_name')->nullable();
            $table->string('company_legal_name')->nullable();
            $table->string('owner_or_manager_name')->nullable();
            $table->string('enter_cr_number')->nullable();
            $table->integer('cr_number_approved')->default('0');
            $table->string('upload_cr')->nullable(); 
            $table->integer('upload_cr_approved')->default('0');
            $table->string('enter_cr_maroof_namber')->nullable();
            $table->integer('cr_maroof_no_approved')->default('0');
            $table->string('upload_maroof')->nullable();
            $table->integer('upload_maroof_approved')->default('0');
            $table->string('date_of_expiry')->nullable();
            $table->string('vat_number')->nullable();
            $table->integer('vat_number_approved')->default('0');
            $table->longtext('vat_certificate_file')->nullable();
            $table->integer('vat_certificate_approved')->default('0');
            $table->longtext('ministry_of_government')->nullable();
            $table->integer('ministry_of_government_approved')->default('0');
            $table->string('bank_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('Iban_number')->nullable();
            $table->string('store_name')->nullable();
            $table->string('store_location')->nullable();
            $table->bigInteger('branch_id')->unsigned()->index()->nullable();
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->bigInteger('city_id')->unsigned()->index()->nullable();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->bigInteger('state_id')->unsigned()->index()->nullable();
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->bigInteger('country_id')->unsigned()->index()->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->bigInteger('store_type_id')->nullable();
            $table->string('shop_sign_file')->nullable();
            $table->string('store_logo_file')->nullable();
            $table->string('store_phone_number')->nullable();
            $table->string('working_hours')->nullable();
            $table->string('website')->nullable();
            $table->string('store_type')->nullable();
            $table->longtext('return_policy_file')->nullable();
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
        Schema::dropIfExists('business_users');
    }
}
