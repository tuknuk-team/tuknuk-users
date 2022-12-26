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
        Schema::create('publications_discover', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('publication_id')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image');
            $table->string('embed')->nullable();
            $table->string('link')->nullable();
            $table->foreign('publication_id')->references('id')->on('publications')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publications_discover');
    }
};
