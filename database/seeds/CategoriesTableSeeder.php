<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cats = ['Pre filter', 'Cabin/AC filter', 'Brake pads',
                 'Oil filter', 'Air Cleaner', 'Spark Plugs', 'Fuel Filter',
                 'Gear/b Oil'];
        foreach($cats as $cat) {
          $category = [
                'name' => $cat,
          ];
          Category::create($category);
        }
    }
}
