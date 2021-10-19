<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pcomments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pcomments', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('creatorid')->unsigned()->default();
            $table->foreign('creatorid')->references('id')->on('users')->change();
            $table->integer('pointid')->unsigned()->default();
            $table->foreign('pointid')->references('id')->on('points')->change();
            $table->integer('rating')->nullable(false);
            $table->string('text', 255)->nullable(false);
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
        Schema::dropIfExists('pcomments');
    }
}
