<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePharmacistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmacists', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('verificationToken')->nullable();
            // verificationStatus types
                    // email not confirmed->0
                    // email confirmed->1
            $table->boolean('verificationStatus')->default('0');
            // status types
                    // pharmacist banned->0
                    // pharmacist not banned->1
            $table->integer('pharmacistStatus')->default('1');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('contact');
            $table->string('pharmacyName');
            $table->string('address');
            $table->string('society');
            $table->string('city');
            $table->float('longitude', 10, 6);
            $table->float('latitude', 10, 6);
            $table->string('freeDeliveryPurchase');
            // Possible data source type
                    // none->0
                    // website db->1
                    // api->2
                    // personal db->3
            $table->string('dataSource')->default('0');
            $table->string('dbAPI')->nullable();
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
        Schema::dropIfExists('pharmacists');
    }
}
