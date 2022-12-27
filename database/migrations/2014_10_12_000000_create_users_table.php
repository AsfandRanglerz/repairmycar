<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->nullable();
            $table->string('landline_no')->nullable();
            $table->string('password')->nullable();
            $table->string('action')->default('0');
            $table->string('facebook_social_id')->nullable();
            $table->string('google_social_id')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->integer('post_box')->nullable();
            $table->double('longitude')->nullable();
            $table->double('latitude')->nullable();
            $table->integer('term_condition')->default(0);
            $table->text('image')->nullable();
            $table->dateTime('online_status')->nullable();
            $table->string('type')->default('user');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}