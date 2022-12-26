<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_notification', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('notification_type_id')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('notification_type_id')->references('id')->on('data_notification_types')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_notification');
    }
};
