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
      // $faker = Faker\Factory::create();
      for ($i=1; $i < 7; $i++) {
        $instance = [
          'service_id' => $i,
          'car_id' => $i,
          'car_model_id' => $i,
          'price' => ($i % 2 == 0) ? 2000000 : 175000,
          'status' => true,
        ];
        ServiceAsProduct::create($instance);
      }
    }
}
