<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateRanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ranks', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name')->nullable(false);
            $table->string('icon')->nullable(false);
            $table->integer('maxrating')->nullable(false);
        });

        DB::table('ranks')->insert(
            array(
                'name' => 'Новичек',
                'icon' => 'green',
                'maxrating'=>200
            )
        );

        DB::table('ranks')->insert(
            array(
                'name' => 'Любитель',
                'icon' => 'yellow',
                'maxrating'=>400
            )
        );

        DB::table('ranks')->insert(
            array(
                'name' => 'Профи',
                'icon' => 'orange',
                'maxrating'=>600
            )
        );

        DB::table('ranks')->insert(
            array(
                'name' => 'Мастер',
                'icon' => 'red',
                'maxrating'=>800
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ranks');
    }
}
