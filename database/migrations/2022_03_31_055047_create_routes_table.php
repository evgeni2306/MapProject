<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('creatorid')->unsigned()->default();
            $table->foreign('creatorid')->references('id')->on('users')->change();
            $table->string('status',255)->nullable(true);
            $table->string('name',255)->nullable(true);
            $table->mediumText('shortdescription')->nullable(true);
            $table->longText('description')->nullable(true);
            $table->string('difficult',255)->nullable(true);
            $table->string('distance',255)->nullable(true);
            $table->string('time',255)->nullable(true);
            $table->integer('rating')->unsigned()->nullable(true);

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
        Schema::dropIfExists('routes');
    }
}
