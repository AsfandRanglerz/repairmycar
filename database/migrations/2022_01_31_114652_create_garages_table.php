<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGaragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('garages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->unsigned()->constrained('vendors')->onDelete('cascade');
            $table->string('trading_no')->nullable();
            $table->string('vat')->nullable();
            $table->string('phone')->nullable();
            $table->string('garage_name')->nullable();
            $table->text('image')->nullable();
            $table->longText('description')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->integer('post_box')->nullable();
            $table->string('rating')->default(0);
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
        Schema::dropIfExists('garage');
    }
}
