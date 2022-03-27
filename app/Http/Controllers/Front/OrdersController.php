<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\ReturnRequest;
use App\ExchangeRequest;
use App\OrdersProduct;
use App\ProductsAttribute;
use App\Cart;
use Session;
use Auth;
use DB;

class OrdersController extends Controller
{
    public function myOrders(){
		$user_id = Auth::user()->id;
		$orders = Order::with('orders_products')->where('user_id',$user_id)->get()->toArray();
		/* echo"<pre>";
		print_r($orders);
		die; */
		return view('front.order.orders')->with(['orders'=>$orders]);
	}
	
	public function GSTCalculate(){
		$cartItems = Cart::cartItems();
		$totalGST = 0;
		foreach($cartItems as $key=>$items){
			$totalPrise = $items['quantity']*$items['product']['product_price'];
			$GstPersent = $items['product']['product_gst'];
			$totalGST = $totalGST + round($totalPrise*$GstPersent/100,2);
		}
		return $totalGST;
	}
	
	public function orderDetails($order_id){
		$totalGST = $this->GSTCalculate();
		$order_details = Order::with('orders_products')->where('id',$order_id)->first()->toArray();
		return view('front.order.order_details')->with(['orderDetails'=>$order_details,'totalGST'=>$totalGST,'page_type'=>'front_page']);
	}
	
	public function orderCancle(Request $request){
		if($request->ajax()){
			$data = $request->all();
			$order = Order::find($data['order_id'])->toArray();
			
			if(!empty($data['order_id']) && $order['order_status']){
				$OrderStatus = Order::find($data['order_id']);
				$OrderStatus->order_status = "Cancelled";
				$OrderStatus->save();
				return response()->json(['status'=>200,'message'=>'Your order cancelled'],200);
			}
			
		}
	}
	public function orderReturn(Request $request){
		if($request->ajax()){
			$data = $request->all();
			
			$order_id = $data['order_id'];
			$product_id = $data['product_id'];
			$product = explode('-', $product_id);
			$product_code = $product[0];
			$productId = $product[1];
			$reason = $data['reason'];
			$comment = $data['comment'];
			$old_size = $data['old_size'];
			$user_id = Auth::user()->id;
			$exchange_type = $data['exchange_type'];
			$exchange_size = $data['exchange_size'];
			
			$user_id_product = OrdersProduct::select('user_id')->where(['order_id'=>$order_id,'product_id'=>$productId,'user_id'=>$user_id])->first()->toArray();
			
			if($user_id_product['user_id'] == $user_id){
				if($exchange_type =="return"){
			
				OrdersProduct::where(['order_id'=>$order_id,'product_id'=>$productId,'user_id'=>$user_id])->update(['item_status'=>'Returns initiates']);
				$returnRequest = new ReturnRequest;
				$returnRequest->user_id = $user_id;
				$returnRequest->order_id = $order_id;
				$returnRequest->product_code = $product_code;
				$returnRequest->product_id = $productId;
				$returnRequest->return_reason = $reason;
				$returnRequest->comment = $comment;
				$returnRequest->return_status = "Pending";
				$returnRequest->save();
				return response()->json(['status'=>200,'message'=>'Your order return submitted'],200);
			}else if($exchange_type =="exchange"){
			
				OrdersProduct::where(['order_id'=>$order_id,'product_id'=>$productId,'user_id'=>$user_id])->update(['item_status'=>'Exchange initiates']);
				$exchangeRequest = new ExchangeRequest;
				$exchangeRequest->order_id = $order_id;
				$exchangeRequest->user_id = $user_id;
				$exchangeRequest->product_size = $old_size;
				$exchangeRequest->required_size = $exchange_size;;
				$exchangeRequest->product_code = $product_code;
				//$exchangeRequest->product_id = $productId;
				$exchangeRequest->exchange_reason = $reason;
				$exchangeRequest->comment = $comment;
				$exchangeRequest->exchange_status = "Pending";
				$exchangeRequest->save();
				return response()->json(['status'=>200,'message'=>'Your order exchange submitted'],200);
			
			}
			
			}else{
				return response()->json(['status'=>200,'message'=>'Your order is not exist for this products'],200);
			}
		}
		
	}
	
	public function orderExchange(Request $request){
		
		if($request->ajax()){
			$data = $request->all();
			$product = explode("-",$data['product_id']);
			$code = $product[0];
			$size = substr($product[1],0,1);
			$codes = $code.'-'.$size;
			$id = $product[2];
			$proSize = ProductsAttribute::select('size')->where('product_id',$id)->where('sku', '!=', $codes)->get();
			return response()->json(['status'=>200,'data'=>$proSize],200);
		}
	
	}
}
