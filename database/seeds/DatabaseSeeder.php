<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
		//$this->call(AdminsTableSeeder::class);
		//$this->call(SectionTableSeeder::class);
		//$this->call(CategoryTableSeeder::class);
		//$this->call(ProductTableSeeder::class);
		//$this->call(ProductsAttributeTableSeeder::class);
		//$this->call(ProductsImageTableSeeder::class);
		//$this->call(BrandsTableSeeder::class);
		//$this->call(BannersTableSeeder::class);
		//$this->call(CouponsTableSeeder::class);
		//$this->call(DeliveryAddressesTableSeeder::class);
		//$this->call(OrderStatusTable::class);
		//$this->call(CmsPagesTableSeeder::class);
		//$this->call(CurrenciesTable::class);
		//$this->call(RatingsTableSeeder::class);
		//$this->call(WishlistsTableSeeder::class);
		//$this->call(ReturnRequestsTableSeeder::class);
		//$this->call(ExchangeRequestTable::class);
		$this->call(NewsletterSubscribersTable::class);
    }
}
