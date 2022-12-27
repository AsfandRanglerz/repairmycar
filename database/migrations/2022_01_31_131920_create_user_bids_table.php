<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_bids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unsigned()->constrained('users')->onDelete('cascade');
            $table->foreignId('company_id')->unsigned()->constrained('companies')->onDelete('cascade');
            $table->foreignId('model_year_id')->unsigned()->constrained('model_years')->onDelete('cascade');
            $table->string('model')->nullable();
            $table->string('mileage')->nullable();
            $table->unsignedInteger('reference_no')->unique()->from(123456)->to(9999999);
            $table->text('description1')->nullable();
            $table->text('description2')->nullable();
            $table->string('car_owner_name')->nullable();
            $table->integer('day')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('offer_status')->nullable();
            $table->enum('status',['active', 'cancel', 'complete'])->default('active');
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
        Schema::dropIfExists('user_bids');
    }
}
