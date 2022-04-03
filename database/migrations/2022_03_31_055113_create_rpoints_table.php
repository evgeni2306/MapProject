<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRpointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rpoints', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('routeid')->unsigned()->default();
            $table->foreign('routeid')->references('id')->on('routes')->change();
            $table->float('lat', 255,7)->nullable(false);
            $table->float('lng', 255,7)->nullable(false);
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
        Schema::dropIfExists('rpoints');
    }
}
