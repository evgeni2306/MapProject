<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users',function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->timestamps();
            $table->string('login',50)->nullable(false)->unique('login');
            $table->string('name',255)->nullable(false);
            $table->string('surname',255)->nullable(false);
            $table->string('password',255)->nullable(false);
            $table->string('avatar', 255)->nullable('true');
            $table->string('transport', 255)->nullable('true');
            $table->text('mapstyle')->nullable(true);
            $table->string('social_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
