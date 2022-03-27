<?php

use Illuminate\Database\Seeder;
use App\Coupon;
class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('coupons')->delete();
        $couponsRecords =[
			['id'=>'1','coupon_option'=>'Manual','coupon_code'=>'Test10','categories'=>'1,2',
			'users'=>'skkhan9708@gmail.com,developer2021@yopmail.com','coupon_type'=>'single',
			'amount_type'=>'percentage','amount'=>'10','expery_date'=>'2021-12-31','status'=>1],
			['id'=>'2','coupon_option'=>'Manual','coupon_code'=>'Demo7','categories'=>'1,5',
			'users'=>'skkhan9708@gmail.com,developer2021@yopmail.com','coupon_type'=>'single',
			'amount_type'=>'fixed','amount'=>'220','expery_date'=>'2021-12-11','status'=>1]
		];
		Coupon::insert($couponsRecords);
    }
}
