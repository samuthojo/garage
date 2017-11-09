<?php

use Illuminate\Database\Seeder;
use App\Customer;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker\Factory::create();

      for ($i=1; $i < 7; $i++) {
          $customer = [
              'email' => $faker->safeEmail(),
              'name' => $faker->name(),
              'phonenumber' => $faker->phoneNumber,
              'verified' => ($i % 2 == 0) ? true : false,
          ];
          Customer::create($customer);
      }
    }
}
