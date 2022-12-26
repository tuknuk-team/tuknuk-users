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
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid')->unique();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('status_id')->nullable();
            $table->string('title');
            $table->text('description');
            $table->string('avatar_url')->nullable();
            $table->string('cover_url')->nullable();
            $table->integer('max_users')->nullable();
            $table->decimal('price', 15, 4)->nullable();
            $table->dateTime('launch_at')->nullable();
            $table->boolean('featured')->default(false);
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('status_id')->references('id')->on('rooms_status')->nullOnDelete();
            $table->timestamps();
        });

        Schema::table('publications', function (Blueprint $table) {
            $table->unsignedInteger('room_id')->nullable()->after('archive_url');
            $table->foreign('room_id')->references('id')->on('rooms')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
        Schema::dropColumns('publications', ['room_id']);
    }
};
