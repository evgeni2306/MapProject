<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRcommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rcomments', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('creatorid')->unsigned()->default();
            $table->foreign('creatorid')->references('id')->on('users')->change();
            $table->integer('routeid')->unsigned()->default();
            $table->foreign('routeid')->references('id')->on('routes')->change();
            $table->timestamps();
            $table->integer('rating')->nullable(false);
            $table->string('text', 255)->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rcomments');
    }
}
