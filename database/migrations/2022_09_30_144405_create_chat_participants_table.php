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
        Schema::create('chats_participants', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('chat_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('chat_id')->references('id')->on('chats')->nullOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->unique([
                'chat_id',
                'user_id'
            ]);
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
        Schema::dropIfExists('chats_participants');
    }
};
