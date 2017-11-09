<?php

use Illuminate\Database\Seeder;

use App\Notification;

class NotificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker\Factory::create();
      for($i = 1; $i < 7; $i++) {
        $notification = [
          'date' => $faker->dateTime(),
          'type' => 'push',
          'message' => $faker->realText(120),
          'status' => ($i % 2 == 0) ? 'read' : 'unread',
          'customer_id' => $i,
        ];
        Notification::create($notification);
      }
    }
}
