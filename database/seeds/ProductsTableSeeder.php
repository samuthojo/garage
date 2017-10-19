<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker\Factory::create();

      $products = [ 'wind mirror','side mirror', 'gear-box',
                    'tyre','car-radio', 'front-lights',
                    'indicator-lights', 'back-lights',
                    'steering cover', 'seat-cover', 'engine',
                ];
      $index = 1;
      foreach($products as $product) {
          $instance = [
              'category_id' => $index,
              'car_id' => $index,
              'car_model_id' => $index,
              'price' => $faker->numberBetween(20000, 2000000),
              'name' => $product,
              'has_includes' => ($index % 2 == 0) ? true : false,
              'includes' => $faker->words(2, true),
              'include_price' => $faker->numberBetween(20000,  70000),
              'unit' => $index,
              'stock' => $faker->numberBetween(20, 300),
              'warranty' => $index . ($index == 1) ? 'year' : 'years',
              'image' => 1 . ".jpg",
          ];
          Product::create($instance);
          ++$index;
      }
    }
}
