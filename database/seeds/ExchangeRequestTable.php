<?php

use Illuminate\Database\Seeder;
use App\ExchangeRequest;
class ExchangeRequestTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('return_requests')->delete();
		$exchangeData =[
			['id'=>'2','order_id'=>'86','user_id'=>'2','product_size'=>'small','required_size'=>'medium','product_code'=>'Htn7001','exchange_reason'=>'required large size', 'exchange_status'=>'Pending','comment'=>'']
		];
		ExchangeRequest::insert($exchangeData);
    }
}
