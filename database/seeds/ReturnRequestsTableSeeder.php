<?php

use Illuminate\Database\Seeder;
use App\ReturnRequest;
class ReturnRequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('return_requests')->delete();
		$returnData = [
		['id'=>1,'user_id'=>'2','product_id'=>'17','order_id'=>'50','product_code'=>'Htn789R001','return_reason'=>'Too late to delivery', 'return_status'=>'Reject','comment'=>'very good product but late to delivery'],
		['id'=>2,'user_id'=>'2','product_id'=>'11','order_id'=>'86','product_code'=>'Htn7001','return_reason'=>'Its late to delivery', 'return_status'=>'Next time','comment'=>'Too late for delivery'],
		];
		ReturnRequest::insert($returnData);
    }
}
