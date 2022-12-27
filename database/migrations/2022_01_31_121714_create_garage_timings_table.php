<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGarageTimingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('garage_timings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('garage_id')->unsigned()->nullable()->constrained('garages')->onDelete('cascade');
            $table->string('day');
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('closed')->nullable();
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
        Schema::dropIfExists('garage_timings');
    }
}
