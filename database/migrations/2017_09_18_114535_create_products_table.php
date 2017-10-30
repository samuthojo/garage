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
          $table->integer('category_id')->unsigned();
          $table->integer('car_id')->unsigned()->nullable();
          $table->integer('car_model_id')->unsigned()->nullable();
          $table->string('name');
          $table->string('unit');
          $table->decimal('price', 14, 0);
          $table->integer('stock')->unsigned();
          $table->boolean('has_includes');
          $table->string('includes')->nullable();
          $table->decimal('include_price', 14, 0)->nullable();
          $table->string('warranty')->nullable();
          $table->string('image')->nullable();
          $table->timestamp('date_added')->nullable();
          $table->timestamp('date_modified')->nullable();
          $table->softDeletes();
          $table->foreign('category_id')->references('id')->on('categories');
          $table->foreign('car_id')->references('id')->on('cars');
          $table->foreign('car_model_id')->references('id')->on('car_models');
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
