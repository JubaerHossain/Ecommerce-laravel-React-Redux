<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('did')->nullable();
            $table->integer('merchant_id');
            $table->integer('user_id')->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 20)->nullable();
            $table->text('address');
            $table->text('products');
            $table->boolean('status')->default(0);
            $table->string('methos', 5)->default('cod');
            $table->integer('subtotal');
            $table->integer('shipping');
            $table->integer('discount')->nullable();
            $table->integer('total');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
