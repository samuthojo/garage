<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_cars', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('car_id')->unsigned();
          $table->integer('car_model_id')->unsigned();
          $table->integer('customer_id')->unsigned();
          $table->timestamp('date_added')->nullable();
          $table->timestamp('updated_at')->nullable();
          $table->softDeletes();
          $table->foreign('car_id')->references('id')->on('cars');
          $table->foreign('customer_id')->references('id')->on('customers');
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
        Schema::dropIfExists('customer_cars');
    }
}
