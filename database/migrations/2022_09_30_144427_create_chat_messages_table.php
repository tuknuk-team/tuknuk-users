<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('chat_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->text('message')->nullable();
            $table->enum('archive_type', array('image', 'video'))->nullable();
            $table->string('archive_url')->nullable();
            $table->unsignedInteger('reply_chat_message_id')->nullable();
            $table->unsignedInteger('forward_chat_message_id')->nullable();
            $table->foreign('chat_id')->references('id')->on('chats')->nullOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('reply_chat_message_id')->references('id')->on('chats_messages')->nullOnDelete();
            $table->foreign('forward_chat_message_id')->references('id')->on('chats_messages')->nullOnDelete();
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
        Schema::dropIfExists('chats_messages');
    }
};
