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
      $faker = Faker\Factory::create();

      $models = [ 'Nissan Patrol', 'Mark II', 'Suzuki', 'BMW',
                  'Mazda', 'Discovery', 'Hyundai',
                  'Audi', 'Jeep', 'Honda', 'Lexus',
            ];
      $pictures = ['nissan.jpg', 'toyota.jpg', 'suzuki.jpg',
                 'bmw.jpg', 'mazda.jpg', 'land-rover.jpg',
                 'hyundai.jpg', 'audi.jpg', 'jeep.jpg',
                 'honda.jpg', 'lexus.jpg', ];
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
