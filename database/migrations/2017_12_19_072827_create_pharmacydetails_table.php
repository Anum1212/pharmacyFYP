<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePharmacydetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Pharmacydetails', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('status');
          $table->string('email')->unique();
          $table->string('pharmacyName');
          $table->string('pharmacyAddress');
          $table->string('freeDeliveryDistance');
          $table->string('freeDeliveryPurchase');
          $table->text('dbAPI');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Pharmacydetails');
    }
}
