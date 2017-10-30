<?php

use Illuminate\Database\Seeder;
use App\Service;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // $faker = Faker\Factory::create();
      $services = [ 'Diagnosis', 'Greesing', 'Check-up',
                    'Camber Adjustment', 'Wheel Balancing',
                    'Wheel Alignment'];
      $index = 1;
      foreach ($services as $service) {
          $instance = [
              'name' => $service,
              'description' => "We do a great service",
              'picture' => $index . ".jpg"
          ];
          Service::create($instance);
          ++$index;
      }
    }
}
