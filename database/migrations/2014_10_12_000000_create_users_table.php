<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->timestamps();
            $table->string('verificationToken')->nullable();
            // verificationStatus types
                    // email not confirmed->0
                    // email confirmed->1
            $table->boolean('verificationStatus')->default('0');
            // status types
                    // user banned->0
                    // user not banned->1
            $table->integer('status')->default('1');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('contact');
            $table->string('address');
            $table->string('society');
            $table->string('city');
            $table->string('longitude');
            $table->string('latitude');
            $table->string('password');
            $table->rememberToken();
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
