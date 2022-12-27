<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimpleAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simple_ads', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('url')->nullable();
            $table->string('email')->nullable();
            $table->string('description')->nullable();
            $table->unsignedBigInteger('packages_id')->nullable();
            $table->foreign('packages_id')->references('id')->on('add_packages')->onDelete('cascade');
            $table->string('status')->default('Pending');
            $table->string('validity')->nullable();
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
        Schema::dropIfExists('simple_ads');
    }
}
