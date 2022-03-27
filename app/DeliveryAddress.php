<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class DeliveryAddress extends Model
{	
	protected $table = 'delivery_addresses';

	public static function DeliveryAddresses(){
		$user_id = Auth::user()->id;
		$deliveryAddress = DeliveryAddress::where('user_id',$user_id)->get()->toArray();
		return $deliveryAddress;
		
	}
}
