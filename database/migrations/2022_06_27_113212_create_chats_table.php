<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->unsignedBigInteger('vendor_sender_id')->nullable();
            $table->foreign('vendor_sender_id')->references('id')->on('vendors')->onDelete('cascade');
            $table->unsignedBigInteger('vendor_receiver_id')->nullable();
            $table->foreign('vendor_receiver_id')->references('id')->on('vendors')->onDelete('cascade');
            $table->unsignedBigInteger('customer_sender_id')->nullable();
            $table->foreign('customer_sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('customer_receiver_id')->nullable();
            $table->foreign('customer_receiver_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('body',5000)->nullable();
            $table->string('attachment')->nullable();
            $table->string('filetext')->nullable();
            $table->string('msgtype')->nullable();
            $table->enum('vendor_file_status',['0','1']);
            $table->enum('customer_file_status',['0','1']);
            $table->boolean('seen')->default(0);
            $table->integer('vendor_deleted')->default(0);
            $table->integer('customer_deleted')->default(0);
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
        Schema::dropIfExists('chats');
    }
}
