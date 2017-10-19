<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
          $table->increments('id');
          $table->decimal('price', 14, 0);
          $table->integer('order_id')->unsigned();
          $table->integer('product_id')->unsigned();
          $table->integer('quantity')->unsigned();
          $table->boolean('has_includes');
          $table->string('includes')->nullable();
          $table->decimal('include_price', 14, 0)->nullable();
          $table->decimal('total_price', 14, 0);
          $table->timestamps();
          $table->softDeletes();
          $table->foreign('order_id')->references('id')->on('orders');
          $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
}
