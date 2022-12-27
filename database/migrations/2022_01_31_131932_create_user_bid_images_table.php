<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBidImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_bid_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_bid_id')->unsigned()->constrained('user_bids')->onDelete('cascade');
            $table->text('car_image');
            $table->enum('type', ['image', 'file','registerImage']);
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
        Schema::dropIfExists('user_bid_images');
    }
}
