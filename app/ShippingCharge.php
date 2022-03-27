<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingCharge extends Model
{
    public static function countryCharge($totalWeight, $country){
		$countryCharges = ShippingCharge::where(['country'=>$country,'status'=>1])->select('0_500g','501_1000g','1001_2000g','20001_5000g','above_5000g')->get()->toArray();

		if($totalWeight >0){
			if($totalWeight <=500){
				$shippingCharges = $countryCharges[0]['0_500g'];
				
			}else if($totalWeight >=501 && $totalWeight <=1000){
			
				$shippingCharges = $countryCharges[0]['501_1000g'];
				
			}else if($totalWeight >=1001 && $totalWeight <=2000){
			
				$shippingCharges = $countryCharges[0]['1001_2000g'];
				
			}else if($totalWeight >=2001 && $totalWeight <=5000){
			
				$shippingCharges = $countryCharges[0]['20001_5000g'];
				
			}else if($totalWeight >=5001 && $totalWeight <=10000){
			
				$shippingCharges = $countryCharges[0]['above_5000g'];
			}
			
		}else{
			$shippingCharges =0;
		}
		return $shippingCharges;
	}
}
