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
        Schema::create('data_privacy_types_connected', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('privacy_type_id')->nullable();
            $table->unsignedInteger('privacy_type_option_id')->nullable();
            $table->boolean('is_default')->default(false);
            $table->foreign('privacy_type_id')->references('id')->on('data_privacy_types')->nullOnDelete();
            $table->foreign('privacy_type_option_id')->references('id')->on('data_privacy_types_options')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_privacy_types_connected');
    }
};
