<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditCustomerCarsTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_cars', function (Blueprint $table) {
          $table->string('make')->nullable();
          $table->string('year')->nullable();
          $table->string('license_plate')->nullable();
          $table->string('vin')->nullable();
          $table->string('color')->nullable();
          $table->bigInteger('maintenance_period')->nullable();
          $table->string('maintenance_period_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_cars', function (Blueprint $table) {
            //
        });
    }
}
