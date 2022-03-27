<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\ProductsAttribute;
use App\Cart;
use App\Order;
use App\User;
use Session;
use Validator;
use Auth;
use DB;

class PaypalController extends Controller
{
    public function payPal(){
	
		//Cart::where('user_id', Auth::user()->id)->delete();
		if(!empty(Session::get('order_id') && Session::get('grand_total'))){
			$orderDetails = Order::where('id',Session::get('order_id'))->first()->toArray();
			$userDetails = User::where('id',$orderDetails['user_id'])->get()->toArray();
			
			return view('front.paypal.paypal')->with(['controller'=>'paypal','orderDetails'=>$orderDetails,'userDetails'=>$userDetails]);
		}else{
			return redirect('/cart');
		}
	}
	
	public function payPalSuccess(){
		if(Session::get('order_id') && Session::get('grand_total')){
			//delete cart products
			Cart::where('user_id', Auth::user()->id)->delete();
			return view('front.paypal.paypal_success')->with(['controller'=>'paypal']);
		}else{
			return redirect('/cart');
		}
	}
	public function payPalFail(){
		Cart::where('user_id', Auth::user()->id)->delete();
		return view('front.paypal.paypal_fail');
	}
	
	public function ipn(Request $request){
		$data = $request->all();
		if($data['payment_status'] =="Completed"){
			$order_id = Session::get('order_id');
			Order::where('id',$order_id)->update(['order_status'=>'Paid']);
			
				$message = "Dear customer, Your order '.$order_id.' has been successfully place with E-comm Muzaffer. 
				We will intimate you once your order is shipped";
				$orderDetails = Order::with('orders_products')->where('id',$order_id)->get()->toArray();
				$userDetails = User::where('id',$orderDetails[0]['user_id'])->get()->toArray();
				$email = Auth::user()->email;
				
				//store management reduce product quantity
				foreach($orderDetails[0]['orders_products'] as $pro){
					$attributeStock = ProductsAttribute::where(['product_id'=>$pro['product_id'],'size'=>$pro['product_size']])->get()->toArray();
					$totalStock = $attributeStock[0]['stock']-$pro['product_qty'];
					ProductsAttribute::where(['product_id'=>$pro['product_id'],'size'=>$pro['product_size']])->update(['stock'=>$totalStock]);
				}
				$messageData =[
					'email'=>$email,
					'name'=>Auth::user()->name,
					'order_id'=>$order_id,
					'orderDetails'=>$orderDetails,
					'userDetails'=>$userDetails
				];
				Mail::send('front.email.order', $messageData, function($message) use($email){
					$message->to($email)->subject('Place order - E-commerce of Muzaffer!');
				});
		}
	}

}
