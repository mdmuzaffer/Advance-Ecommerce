<?php

use Illuminate\Database\Seeder;
use App\Rating;
class RatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->delete();
		
		$ratings = [
		['id'=>1,'user_id'=>'2','product_id'=>'17','review'=>'very good product','rating'=>'4','status'=>'0'],
		['id'=>2,'user_id'=>'3','product_id'=>'8','review'=>'Nice product','rating'=>'5','status'=>'0'],
		['id'=>3,'user_id'=>'8','product_id'=>'12','review'=>'Oweasom product','rating'=>'3','status'=>'0'],
		['id'=>4,'user_id'=>'5','product_id'=>'4','review'=>'Good product I am using it','rating'=>'4','status'=>'0'],
		];
		Rating::insert($ratings);
    }
}
