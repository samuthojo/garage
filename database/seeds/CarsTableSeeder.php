<?php

use Illuminate\Database\Seeder;
use App\Car;

class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cars = [ 'Nissan', 'Toyota', 'Suzuki', 'BMW',
                  'Mazda', 'Land Rover', 'Hyundai',
                  'Audi', 'Jeep', 'Honda', 'Lexus',
              ];
        $images = ['nissan.jpg', 'toyota.jpg', 'suzuki.jpg',
                   'bmw.jpg', 'mazda.jpg', 'land-rover.jpg',
                   'hyundai.jpg', 'audi.jpg', 'jeep.jpg',
                   'honda.jpg', 'lexus.jpg', ];
        $index = 1; $i = 0;
        foreach($cars as $car) {
            $instance = [
                'name' => $car,
                'picture' => $images[$i],
            ];
            Car::create($instance);
            (++$index == 5) ? $index = 1 : "";
            ++$i;
        }
    }
}
