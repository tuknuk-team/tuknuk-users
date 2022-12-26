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
        Schema::create('data_genres', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('genre_id')->nullable()->after('birth_date');
            $table->foreign('genre_id')->references('id')->on('data_genres')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_genres');

        Schema::dropColumns('users', ['genre_id']);
    }
};
