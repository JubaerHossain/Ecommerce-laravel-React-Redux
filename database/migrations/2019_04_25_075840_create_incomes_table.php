<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dpid');
            $table->float('self', 8,2)->default(0);
            $table->float('a', 8,2)->default(0);
            $table->float('b', 8,2)->default(0);
            $table->float('c', 8,2)->default(0);
            $table->float('d', 8,2)->default(0);
            $table->float('e', 8,2)->default(0);
            $table->float('f', 8,2)->default(0);
            $table->float('g', 8,2)->default(0);
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
        Schema::dropIfExists('incomes');
    }
}
