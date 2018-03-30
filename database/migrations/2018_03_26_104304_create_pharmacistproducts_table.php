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
            $table->string('name');
            // possible types of medicine
            // 1 -> tablet
            // 2 -> capsule
            // 3 -> syrup
            // 4 -> inhaler
            // 5 -> drops
            // 6 -> injection
            // 7 -> cream
            $table->string('dosage');
            $table->integer('type');
            $table->string('price');
            $table->integer('quantity');
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
