<?php

use Illuminate\Database\Seeder;
use App\Device;

class DevicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker\Factory::create();

      for ($i=1; $i < 12; $i++) {
          $device = [
              'token' => $faker->sha1(),
              'customer_id' => $i,
          ];
          Device::create($device);
      }
    }
}
