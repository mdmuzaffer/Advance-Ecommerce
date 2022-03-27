<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Wishlist extends Model
{
	public static function wishlistCount($product_id){
		$wishlist = Wishlist::where(['user_id'=>Auth::user()->id,'product_id'=>$product_id])->count();
		return $wishlist;
	}
	
	
	public static function userWishlistItems(){
		$wishlis = Wishlist::with(['product'=>function($query){
			$query->select('id','product_name','product_code','product_color','product_price','main_image');
		}])->where('user_id',Auth::user()->id)->orderBy('id', 'DESC')->get()->toArray();
		return $wishlis;
	}
	
	public function product(){
		 return $this->belongsTo('App\product', 'product_id');
	}
}
