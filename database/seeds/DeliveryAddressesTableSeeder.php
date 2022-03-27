<?php

use Illuminate\Database\Seeder;
use App\DeliveryAddress;
class DeliveryAddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('delivery_addresses')->delete();
		$deliveryAddress =[
			['id'=>'1','user_id'=>'2','name'=>'Muzaffer','address'=>'Dagurwa','city'=>'Purnia','state'=>'Bihar','country'=>'India','pincode'=>'854326','mobile'=>'7896541235','status'=>'1'],
			['id'=>'2','user_id'=>'3','name'=>'Ramesh','address'=>'Phase-5','city'=>'Mohali','state'=>'Punjab','country'=>'India','pincode'=>'160059','mobile'=>'2365897415','status'=>'1'],
		];
		DeliveryAddress::insert($deliveryAddress);
    }
}
