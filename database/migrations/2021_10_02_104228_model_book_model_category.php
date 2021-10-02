<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModelBookModelCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('model_book_model_category', function (Blueprint $table) {
           $table->id();
           $table->unsignedBigInteger('model_book_id')->nullable();
           $table->unsignedBigInteger('model_category_id')->nullable();
           $table->timestamps();
           $table->foreign('model_book_id')->references('id')->on('books');
           $table->foreign('model_category_id')->references('id')->on('category');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_book_model_category');
    }
}
