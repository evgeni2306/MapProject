<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('creatorid')->unsigned()->default();
            $table->foreign('creatorid')->references('id')->on('users')->change();
            $table->timestamps();
            $table->float('lat', 255,7)->nullable(false);
            $table->float('lng', 255,7)->nullable(false);
            $table->string('name',255)->nullable(true);
            $table->string('address',255)->nullable(true);
            $table->string('status',255)->nullable(true);
            $table->string('type',255)->nullable(true);
            $table->string('icon',255)->nullable(true);
            $table->string('city',255)->nullable(true);
            $table->mediumText('shortdescription')->nullable(true);
            $table->longText('description')->nullable(true);
            $table->integer('rating')->unsigned()->nullable(true);
            $table->string('photo',255)->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('points');
    }
}
