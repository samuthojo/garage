<?php

use Illuminate\Database\Seeder;
use App\OrderPromoMessage;

class OrderPromoMessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      OrderPromoMessage::create(['message' => 'MechMaster cares for your car!']);
    }
}
