<?php

use Illuminate\Database\Seeder;
use App\Order;

class OrdersTableSeeder extends Seeder
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
          $order = [
              'date' => $faker->dateTime(),
              'updated_at' => $faker->dateTime(),
              'customer_id' => $i,
              'num_items' => 1,
              'amount' => $faker->numberBetween(100000, 5000000),
              'status' => ($i % 2 == 0) ? 0 : 1,
              'comment' => $faker->realText(120),
          ];
          Order::create($order);
      }
    }
}
