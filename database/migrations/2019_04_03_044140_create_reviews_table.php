<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    public function up(){
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('rate');
            $table->longText('text');
            $table->timestamps();
        });
    }
    public function down(){
        Schema::dropIfExists('reviews');
    }
}
