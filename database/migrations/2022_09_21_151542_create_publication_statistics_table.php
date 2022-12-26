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
        Schema::create('publications_statistics', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('publication_id')->nullable();
            $table->integer('views')->default(0);
            $table->integer('likes')->default(0);
            $table->integer('comments')->default(0);
            $table->integer('shared')->default(0);
            $table->integer('reports')->default(0);
            $table->integer('sended')->default(0);
            $table->foreign('publication_id')->references('id')->on('publications')->nullOnDelete();
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
        Schema::dropIfExists('publications_statistics');
    }
};
