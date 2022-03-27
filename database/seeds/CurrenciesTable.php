<?php

use Illuminate\Database\Seeder;
use App\Currency;
class CurrenciesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('currencies')->delete();
        $currencyExch = [
		['id'=>1,'currency_code'=>'USD','exchange_rate'=>'74','status'=>'1'],
		['id'=>2,'currency_code'=>'GBP','exchange_rate'=>'101','status'=>'1'],
		['id'=>3,'currency_code'=>'EUR','exchange_rate'=>'86','status'=>'1'],
		['id'=>4,'currency_code'=>'AUD','exchange_rate'=>'53','status'=>'1'],
		['id'=>5,'currency_code'=>'CAD','exchange_rate'=>'57','status'=>'1'],
		];
		Currency::insert($currencyExch);
    }
}
