<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVariationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->string('color',15);
            $table->string('size',10);
            $table->string('unit',10);
            $table->integer('qty');
            $table->integer('price');
            $table->integer('v_price');
            $table->integer('discount')->nullable();
            $table->string('image')->nullable();
            $table->boolean('onload')->default(0);
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('variations');
    }
}
