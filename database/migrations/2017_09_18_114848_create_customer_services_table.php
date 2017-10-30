<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_services', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('customer_id')->unsigned();
          $table->integer('service_as_product_id')->unsigned();
          $table->integer('status')->unsigned();
          $table->text('comment')->nullable();
          $table->string('description')->nullable();
          $table->boolean('pick_option');
          $table->double('latitude', 20, 10)->nullable();
          $table->double('longitude', 20, 10)->nullable();
          $table->string('location_name')->nullable();
          $table->date('date');
          $table->timestamps();
          $table->softDeletes();
          $table->foreign('customer_id')->references('id')->on('customers');
          $table->foreign('service_as_product_id')->references('id')->on('service_as_products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_services');
    }
}
