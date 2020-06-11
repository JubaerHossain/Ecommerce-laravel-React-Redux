<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUplinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uplines', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->unique();
            $table->integer('a')->unsigned()->nullable();
            $table->integer('b')->unsigned()->nullable();
            $table->integer('c')->unsigned()->nullable();
            $table->integer('d')->unsigned()->nullable();
            $table->integer('e')->unsigned()->nullable();
            $table->integer('f')->unsigned()->nullable();
            $table->integer('g')->unsigned()->nullable();
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
        Schema::dropIfExists('uplines');
    }
}
