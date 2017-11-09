<?php

use Illuminate\Database\Seeder;
use App\CustomerService;

class CustomerServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker\Factory::create();

      $st = [0, 1, 2, 3, 4];
      $index = 0;
      for ($i=1; $i < 7; $i++) {
          $customerService = [
              'customer_id' => $i,
              'service_as_product_id' => $i,
              'price' => $faker->numberBetween(100000, 700000),
              'pick_option' => ($i % 2 == 0) ? true : false,
              'latitude' => $faker->latitude(),
              'longitude' => $faker->longitude(),
              'location_name' => $faker->city(),
              'status' => $st[$index],
              'comment' => $faker->realText(120),
              'description' => $faker->realText(120),
              'date' => $faker->date(),
          ];
          CustomerService::create($customerService);
          ($index <= 3) ? $index++ : $index = 0;
      }
    }
}
