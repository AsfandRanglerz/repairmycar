<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_vendors', function (Blueprint $table) {
            $table->id();
            $table->string('car_model')->nullable();
            $table->string('car_make')->nullable();
            $table->string('category')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('contact_no')->nullable();
            $table->longText('detail')->nullable();
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
        Schema::dropIfExists('contact_vendors');
    }
}
