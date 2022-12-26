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
        Schema::create('data_notification_channels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('name')->nullable();
        });

        Schema::table('users_notification', function (Blueprint $table) {
            $table->unsignedInteger('notification_channel_id')->nullable()->after('notification_type_id');
            $table->foreign('notification_channel_id')->references('id')->on('data_notification_channels')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_notification_channels');
        Schema::dropColumns('users_notification', ['notification_channel_id']);
    }
};
