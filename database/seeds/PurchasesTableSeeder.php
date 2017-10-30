<?php

use Illuminate\Database\Seeder;
use App\Purchase;

class PurchasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // $faker = Faker\Factory::create();
      //
      // for ($i=1; $i < 12; $i++) {
      //     $purchase = [
      //         'price' => $faker->numberBetween(20000, 2000000),
      //         'order_id' => $i,
      //         'product_id' => $i,
      //         'quantity' => $faker->numberBetween(0, 6),
      //         'has_includes' => ($i % 2 == 0) ? true : false,
      //         'includes' => $faker->words(2, true),
      //         'include_price' => ($index % 2 == 0) ? 2000000 : 175000,
      //         'total_price' => $faker->numberBetween(40000, 4000000),
      //     ];
      //     Purchase::create($purchase);
      // }
    }
}
