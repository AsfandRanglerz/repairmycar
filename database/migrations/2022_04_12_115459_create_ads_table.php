<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->text('images');
            $table->text('document_file');
            $table->string('model');
            $table->foreignId('company_id')->unsigned()->constrained('companies')->onDelete('cascade');
            $table->foreignId('model_year_id')->unsigned()->constrained('model_years')->onDelete('cascade');
            $table->integer('price')->nullable();
            $table->string('color')->nullable();
            $table->string('engine')->nullable();
            $table->bigInteger('phone')->nullable();
            $table->bigInteger('landline_no')->nullable();
            $table->string('address')->nullable();
            $table->integer('mileage')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default('Pending');
            $table->foreignId('vendor_id')->unsigned()->nullable()->constrained('vendors')->onDelete('cascade');
            $table->foreignId('user_id')->unsigned()->nullable()->constrained('users')->onDelete('cascade');
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
        Schema::dropIfExists('ads');
    }
}
