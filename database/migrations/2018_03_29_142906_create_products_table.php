<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('merchant_id')->unsigned();
            $table->string('name');
            $table->string('slug')->unique();
            $table->integer('category_id')->unsigned();
            $table->string('string',30);
            $table->string('brand',30)->nullable();
            $table->string('images');
            $table->string('thumbnail');
            $table->integer('discount')->nullable();
            $table->string('dvar')->nullable();
            $table->boolean ('offline')->default(0);
            $table->boolean('status')->default(0);
            $table->boolean('adstatus')->default(0);
            $table->integer('views')->default(0);
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
        Schema::dropIfExists('products');
    }
}
