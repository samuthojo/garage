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
      // $faker = Faker\Factory::create();

      $products = [ 'SteriPEN', 'ACDelco', 'RINGSPANN',
                    'RYCO Oil Filter','MUSTANG 13', 'NGK Spark Plugs',
                    'Paxton Superchargers', 'Motul 2-stroke'
                ];
      $index = 1;
      foreach($products as $product) {
          $instance = [
              'category_id' => $index,
              'car_id' => $index,
              'car_model_id' => $index,
              'price' => ($index % 2 == 0) ? 2000000 : 175000,
              'name' => $product,
              'has_includes' => ($index % 2 == 0) ? true : false,
              'includes' => ($index % 2 == 0) ? 'Oil, Filter' : 'A/C, Mirror',
              'include_price' => ($index % 2 == 0) ? 2000000 : 175000,
              'unit' => $index,
              'stock' => ($index % 2 == 0) ? 2000 : 175,
              'warranty' => $index . ($index % 2 == 0) ? ' months':' years',
              'image' => ($index != 6) ? $index . ".jpg" : $index . ".png"
          ];
          Product::create($instance);
          ++$index;
      }
    }
}
