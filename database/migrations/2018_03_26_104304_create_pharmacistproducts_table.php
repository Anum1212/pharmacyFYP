<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePharmacistproductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmacistproducts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('pharmacistId');
            $table->string('pharmacistName');
            $table->string('name');
            $table->string('genericName');
            // possible categories 
            // 1) Medicine 
            // 2) Proteins and Suppliments 
            // 3) Baby and Mom 
            // 4) Beauty 
            // 5) HouseHold 
            // 6) Others
            $table->integer('category');
            $table->integer('tablets');
            $table->string('manufacturer');
            $table->string('dosage');
            // possible types of medicine
            // 1 -> tablet
            // 2 -> capsule
            // 3 -> syrup
            // 4 -> inhaler
            // 5 -> drops
            // 6 -> injection
            // 7 -> cream
            // 8 -> others
            $table->integer('type');
            // possible prescription status
            // 0 -> not required
            // 1 -> required
            $table->integer('prescription');
            $table->string('price');
            $table->integer('quantity');
            // possible status type
            // 0 -> product discontinued
            // 1 -> product offered by pharmacist
            $table->integer('status')->default('1');
            // possible productSource type
            // 1 -> local website Storage
            // 2 -> api
            // 3 -> socket
            $table->integer('productSource')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pharmacistproducts');
    }
}
