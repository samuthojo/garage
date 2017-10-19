<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
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
          $user = [
              'firstname' => $faker->firstName(),
              'lastname' => $faker->lastName(),
              'username' => $faker->firstName(),
              'password' => Hash::make(str_random(10)),
          ];
          User::create($user);
      }
      $user = [
          'firstname' => 'Admin',
          'lastname' => 'Admin',
          'username' => 'admin',
          'password' => Hash::make('@dm!n'),
      ];
      User::create($user);
    }
}
