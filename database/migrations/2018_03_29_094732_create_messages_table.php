<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('repliedToId')->nullable();
            $table->string('name');
            $table->string('recipientEmail');
            $table->string('senderEmail');
            $table->text('message');
            // Possible status type
                // 0 -> UnRead message
                // 1 -> admin only Read message
                // 2 -> admin replied to messages
                // 3 -> indicates that message is admin response
            $table->integer('status')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
