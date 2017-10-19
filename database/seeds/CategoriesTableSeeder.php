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
        $cats = ['Family cars', 'Luxury cars', 'Saloons',
                 'Sports cars', 'Buses', 'Vans', 'MiniBuses',
                 'MicroVans', 'German cars', 'France cars',
                  'Royal cars'];
        foreach($cats as $cat) {
          $category = [
                'name' => $cat,
          ];
          Category::create($category);
        }
    }
}
