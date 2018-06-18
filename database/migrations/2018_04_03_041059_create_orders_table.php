<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('userId');
            $table->string('cost');
            // possible status types
            //     0 -> not delivered
            //     1 -> delivered
            //     2 -> cancelled
            $table->integer('status')->default('0');
            // possible prescription status
            //     0 -> not required
            //     1 -> required
            $table->integer('prescription')->default('0');
            // possible rating status
            //     0 -> initial state (nothing happens)
            //     1 -> rating requires (after 12 hours of order cron job changes rating status to 1 and rate product alert starts showing)
            //     2 -> rating done
            //     3 -> user doesn't want to rate
            $table->integer('ratingStatus')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
