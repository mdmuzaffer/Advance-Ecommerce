<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Softon\Indipay\Facades\Indipay;
use Illuminate\Support\Facades\Mail;
use App\ProductsAttribute;
use App\Cart;
use App\Order;
use App\User;
use Session;
use Auth;


class PayumoneyController extends Controller
{
	
	public function payUmoney(){
		if(!empty(Session::get('order_id') && Session::get('grand_total'))){
			$orderDetails = Order::where('id',Session::get('order_id'))->first()->toArray();
			$userDetails = User::where('id',$orderDetails['user_id'])->get()->toArray();
		
			$parameters = [
			'txnid' => $orderDetails['id'],
			'amount' => $orderDetails['grand_total'],
			'firstname' => $orderDetails['name'],
			'lastname' => $orderDetails['name'],
			'email' => $orderDetails['email'],
			'phone' => $orderDetails['mobile'],
			'productinfo' => $orderDetails['id'],
			'service_provider' => 'E-commerce',
			'zipcode' => $orderDetails['pincode'],
			'city' => $orderDetails['city'],
			'state' => $orderDetails['state'],
			'country' => $orderDetails['country'],
			'address1' => $orderDetails['address'],
			'address2' => $orderDetails['state'],
			'curl' => url('/payumoney/response')
		  ];
		  $order = Indipay::prepare($parameters);
		  return Indipay::process($order);
				
		}else{
			return redirect('/cart');
		}
	
	}
	
	public function payumoneyResponse(Request $request){
		//For default Gateway
        //$response = Indipay::response($request);

		$request['status'] = "success";
		$request['unmappedstatus'] = "captured";
	
		if($request['status'] =="success" && $request['unmappedstatus'] = "captured"){
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
			Cart::where('user_id', Auth::user()->id)->delete();
			return view('front.payumoney.payumoney_success');
		}else{
			$order_id = Session::get('order_id');
			Order::where('id',$order_id)->update(['order_status'=>'Fail']);
			return view('front.payumoney.payumoney_fail');
		}
		 
	
	}
	
	public function payUmoneyFail(){
		$order_id = Session::get('order_id');
		Order::where('id',$order_id)->update(['order_status'=>'Fail']);
		Cart::where('user_id', Auth::user()->id)->delete();
		return view('front.payumoney.payumney_fail');
	
	}
	
	public function payUmoneyVerify($id =null){
	
		if($id>0){
			$order = Order::where(['id'=>$id])->get();
		}else{
			$orders = Order::where(['payment_method'=>'PayUmoney'])->take(5)->orderBy('id','DESC')->get();
			
			foreach($orders as $key=>$order){
			$key = 'gtKFFx';
			$salt = 'eCwWELxi';
			$command = "verify_payment";
			$var1 =$order->id;
			$hash_str = $key  . '|' . $command . '|' . $var1 . '|' . $salt ;
			$hash = strtolower(hash('sha512', $hash_str));
			$r = array('key' => $key , 'hash' =>$hash , 'var1' => $var1, 'command' => $command);

			$qs= http_build_query($r);
			$wsUrl = "https://test.payu.in/merchant/postservice?form=2";
			$c = curl_init();
			curl_setopt($c, CURLOPT_URL, $wsUrl);
			curl_setopt($c, CURLOPT_POST, 1);
			curl_setopt($c, CURLOPT_POSTFIELDS, $qs);
			curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 30);
			curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($c, CURLOPT_SSL_VERIFYPEER, 0);
			$o = curl_exec($c);
			if (curl_errno($c)) {
			  $sad = curl_error($c);
			  throw new Exception($sad);
			}
			curl_close($c);

			$valueSerialized = @unserialize($o);
			if($o === 'b:0;' || $valueSerialized !== false) {
			  print_r($valueSerialized);
			} 
			$o = json_decode($o);
	 
			//Get last few orders (Example of Laravel code)
			//$orders = Order::where(['payment_method'=>'PayUmoney'])->take(30)->orderBy('id','DESC')->get();
			//$orders = json_decode(json_encode($orders));
			//$order = Order::where(['id'=>$id])->first();
			
				foreach($o->transaction_details as $key => $val){
					if(($val->status=="success")&&($val->unmappedstatus=="captured")){
						if($order->order_status == "Payment Cancelled"){
							Order::where(['id' => $order->id])->update(['order_status' => 'Paid']);
						} else if($order->order_status == "Payment Fail"){
							Order::where(['id' => $order->id])->update(['order_status' => 'Paid']);
						} else if($order->order_status == "New"){
							Order::where(['id' => $order->id])->update(['order_status' => 'Paid']);
						}                   
					}else{
						if($order->order_status == "Payment Captured"){
							Order::where(['id' => $order->id])->update(['order_status' => 'Payment Cancelled']);
						} else if($order->order_status == "New"){
							Order::where(['id' => $order->id])->update(['order_status' => 'Payment Cancelled']);
						}
					}
				}
				echo "cron job run successfully"; die; 
				
				}
		}

    }
        

}
