<?php

use Illuminate\Database\Seeder;
use App\ServicePromoMessage;

class ServicePromoMessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      ServicePromoMessage::create(['message' => 'MechMaster services the solution!']);
    }
}
