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
        Schema::create('publications_comments_statistics', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('comment_id')->nullable();
            $table->foreign('comment_id')->references('id')->on('publications_comments')->nullOnDelete();
            $table->integer('likes')->default(0);
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
        Schema::dropIfExists('publications_comments_statistics');
    }
};
