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
        $cars = [ 'Nissan', 'Toyota', 'BMW',
                  'Mazda', 'Land Rover', 'Hyundai',
                  'Mitsubishi', 'Ford'
              ];
        $images = ['nissan.jpg', 'toyota.jpg',
                   'bmw.jpg', 'mazda.jpg', 'land-rover.jpg',
                   'hyundai.jpg', 'mitsubishi.png', 'ford.png' ];
        $i = 0;
        foreach($cars as $car) {
            $instance = [
                'name' => $car,
                'picture' => $images[$i],
            ];
            Car::create($instance);
            ++$i;
        }
    }
}
