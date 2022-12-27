<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->nullable();
            $table->string('landline_no')->nullable();
            $table->string('password');
            $table->string('action')->default('0');
            $table->string('facebook_social_id')->nullable();
            $table->string('google_social_id')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->integer('post_box')->nullable();
            $table->double('longitude')->nullable();
            $table->double('latitude')->nullable();
            $table->text('image')->nullable();
            $table->text('id_card')->nullable();
            $table->string('appointment_number')->nullable();
            $table->string('garage_name')->nullable();
            $table->string('garages_catagory')->nullable();
            $table->string('trading_license')->nullable();
            $table->string('image_license')->nullable();
            $table->string('vat')->nullable();
            $table->string('billing_area')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('billing_address')->nullable();
            $table->integer('term_condition')->default(0);
            $table->dateTime('online_status')->nullable();
            $table->integer('balance')->default(0);
            $table->string('type')->default('vendor');


            $table->rememberToken();
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
        Schema::dropIfExists('vendors');
    }
}
