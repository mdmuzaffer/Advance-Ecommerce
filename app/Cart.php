<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;
use App\Product;

class Cart extends Model
{
    public static function cartItems(){
		if(Auth::check()){
			$user_id = Auth::user()->id;
			$userCartItems =Cart::with('product')->where('user_id',$user_id)->get()->toArray();
		}else{
			$session_id = Session::get('session_id');
			if(empty($session_id)){
			$session_id = Session::getId();
			}
			$userCartItems =Cart::with('product')->where('session_id',$session_id)->get()->toArray();
		}
		return $userCartItems;
	}
	public function product(){
		return $this->belongsTo('App\Product', 'product_id');
	}
	
	public static function ProductsAttrPrice($product_id, $size){
		$ProductsAttr = ProductsAttribute::select('price')->where(['product_id'=>$product_id,'size'=>$size])->first()->toArray();
		return $ProductsAttr;
	}
}
