<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointphotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pointphotos',function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('pointid')->unsigned()->default();
            $table->foreign('pointid')->references('id')->on('points')->change();
            $table->timestamps();
            $table->string('photo1',255)->nullable(true);
            $table->string('photo2',255)->nullable(true);
            $table->string('photo3',255)->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pointphotos');
    }
}
