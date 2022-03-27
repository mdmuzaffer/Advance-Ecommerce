<?php 
use App\Cart;
use App\User;
use App\Product;

function totalCartItems(){
	if(Auth::check()){
		$userId = Auth::user()->id;
		$totalItems = Cart::where('user_id',$userId)->sum('quantity');
	}else{
		$session_id = Session::get('session_id');
		$totalItems = Cart::where('session_id',$session_id)->sum('quantity');
	}
	return $totalItems;
}

 function DateFormate($mydate)
{
   $date = date('d-m-Y', strtotime($mydate));
   return $date;
   //return $data = "This is the test";
}

function userEmail($id){
	return User::find($id);
}

 function CatProductCount($catId){
	return Product::where(['category_id'=>$catId,'status'=>1])->count();
}