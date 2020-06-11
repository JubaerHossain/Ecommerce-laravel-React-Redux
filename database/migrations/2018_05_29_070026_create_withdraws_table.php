<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraws', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsignrd();
            $table->float('target', 8,2)->unsignrd();
            $table->float('incentive', 8,2)->unsignrd();
            $table->float('snd', 8,2)->unsignrd();
            $table->float('achieved', 8,2)->unsignrd();
            $table->float('approved', 8,2)->unsignrd();
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
        Schema::dropIfExists('withdraws');
    }
}
