<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCoulmnInUserBid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_bids', function (Blueprint $table) {
            $table->string('color')->nullable();
            $table->string('Chasis_no')->nullable();
            $table->string('registration_no')->nullable();
            $table->string('looking_for')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_bids', function (Blueprint $table) {
            //
        });
    }
}
