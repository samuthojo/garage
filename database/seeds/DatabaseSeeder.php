<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CarsTableSeeder::class);
        $this->call(CarModelsTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(ServiceAsProductsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(CustomerCarsTableSeeder::class);
        $this->call(CustomerServicesTableSeeder::class);
        $this->call(DevicesTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(PurchasesTableSeeder::class);
        $this->call(NotificationsTableSeeder::class);
    }
}
