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
      $faker = Faker\Factory::create();
      $services = [ 'washing', 'clean engine', 'replace side-mirror',
                    'replace back-mirror', 'replace front-mirror',
                    'change gear-box', 'refuel', 'break fuel',
                    'change tyres', 'repair engine',
                    'sound system repair',
                  ];
      $index = 1;
      foreach ($services as $service) {
          $instance = [
              'name' => $service,
              'description' => $faker->paragraph(3, true),
              'picture' => 1 . ".jpg",
          ];
          Service::create($instance);
          ++$index;
      }
    }
}
