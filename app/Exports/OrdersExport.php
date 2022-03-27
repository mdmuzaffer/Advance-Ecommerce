<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\withHeadings;
use App\Order;
class OrdersExport implements withHeadings, FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $orderData = Order::all();
		return $orderData;
    }
	
	public function headings():array{
		return['Id','User_id','Name','Address','City','State','Country','Pincode','Mobile','Email','Shipping charge','Coupon_code','Coupon_amount','Order status','Payment method','Payment gatway','Grand total','Courier name','Tracking number', 'Created_at','Update_at','Google_id'];
	}
}
