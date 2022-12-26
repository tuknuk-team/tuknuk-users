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
        Schema::create('publications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid')->unique();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('type_id')->nullable();
            $table->text('text');
            $table->boolean('is_private')->default(false);
            $table->boolean('is_draft')->default(false);
            $table->boolean('is_spoiler')->default(false);
            $table->string('archive_url')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('type_id')->references('id')->on('publications_type')->nullOnDelete();
            $table->unsignedInteger('status_id')->nullable()->default(1);
            $table->foreign('status_id')->references('id')->on('publications_status')->nullOnDelete();
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
        Schema::dropIfExists('publications');
    }
};
