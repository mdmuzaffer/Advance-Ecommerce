<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Product;
use App\Wishlist;
Use DB;
use Auth;
class WishlistController extends Controller
{
    public function mywishlist(){
		$userWishlistItems = Wishlist::userWishlistItems();
		$meta_title = "Wishlist -Ecomm website";
		$meta_description = "View wishlist of ecomm website";
		$meta_keyword = "Wishlist ecomm website";
		//return view('front.product.wishlist')->with(compact('userWishlistItems','meta_title','meta_description','meta_keyword'));
		return view('front.cart.wishlist')->with(['controller'=>'product','cartItems'=>$userWishlistItems,'meta_title'=>$meta_title,'meta_description'=>$meta_description,'meta_keyword'=>'$meta_keyword','page_type'=>'front_page']);
		
	}
	
	public function wishlistDelete(Request $request){
		if($request->ajax()){
			$deleteData = $request->all();
			$product_id = $deleteData['product_id'];
			$user_id = Auth::user()->id;
			DB::table('wishlists')->where(['id'=>$product_id,'user_id'=>$user_id])->delete();
			$cartItems = Wishlist::userWishlistItems();
			//return response()->json(['status'=>true, 'page_type'=>'front_page', 'view'=>(String)View::make('front.cart.wishlist_list')->with(compact('cartItems'))]);
			return response()->json(['view' => view('front.cart.wishlist_list', compact('cartItems'))->render()]);
		}
	}
}
