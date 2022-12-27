<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsuranceRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurance_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->unsigned()->constrained('users')->onDelete('cascade');
            $table->foreignId('customer_id')->unsigned()->constrained('users')->onDelete('cascade');
            $table->foreignId('vendor_bid_id')->unsigned()->constrained('vendor_bids')->onDelete('cascade');
            $table->string('payment')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('insurance_requests');
    }
}
