<?php

use Illuminate\Database\Seeder;
use App\ServiceAsProduct;

class ServiceAsProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker\Factory::create();
      for ($i=1; $i < 12; $i++) {
        $instance = [
          'service_id' => $i,
          'car_id' => $i,
          'car_model_id' => $i,
          'price' => $faker->numberBetween(20000, 700000),
          'status' => 'Active',
        ];
        ServiceAsProduct::create($instance);
      }
    }
}
