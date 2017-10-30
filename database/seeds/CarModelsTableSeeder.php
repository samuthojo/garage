<?php

use Illuminate\Database\Seeder;
use App\CarModel;

class CarModelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // $faker = Faker\Factory::create();

      $models = [ 'Datsun', 'Mark II', 'Series 2',
                  'Escape', 'Discovery III', 'Hyundai',
                  'Pajero', 'Ranger'];
      $pictures = ['nissan.jpg', 'toyota.jpg',
                 'bmw.jpg', 'mazda.jpg', 'land-rover.jpg',
                 'hyundai.jpg', 'mitsubishi.png', 'ford.png'];
      $index = 0;
      foreach ($models as $model) {
          $carModel = [
              'car_id' => $index + 1,
              'model_name' => $model,
              'picture' => $pictures[$index],
          ];
          CarModel::create($carModel);
          ++$index;
      }
    }
}
