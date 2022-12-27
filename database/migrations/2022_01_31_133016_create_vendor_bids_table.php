<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_bids', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('garage_id');
            $table->foreign('garage_id')->references('id')->on('garages')->onDelete('cascade');
            $table->unsignedBigInteger('user_bid_id');
            $table->foreign('user_bid_id')->references('id')->on('user_bids')->onDelete('cascade');
            $table->integer('price');
            $table->string('time');
            $table->text('description');
            $table->enum('status',['none', 'accept', 'cancel'])->nullable();
            $table->string('new')->nullable();
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
        Schema::dropIfExists('vendor_bids');
    }
}
