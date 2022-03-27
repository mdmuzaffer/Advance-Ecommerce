<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Exports\OrdersExport;
use App\Order;
use App\User;
use App\OrderStatus;
use App\OrderLog;
use App\OrdersProduct;
use App\Cart;
use Session;
use Auth;
use DB;
use Excel;
use Dompdf\Dompdf;
use App\AdminsRole;
use App\ReturnRequest;
use App\ExchangeRequest;

class OrdersController extends Controller
{
	public function orders(){
    Session::put('page','order');
	$orderData = Order::with('orders_products')->orderBy('id','DESC')->get()->toArray();
	
	// added order for page access
		$orderModule = AdminsRole::where(['admin_id'=>Auth::guard('admin')->user()->id,'model'=>'order'])->count();
		if(isset($orderModule) && $orderModule==0){
			return back()->with('success','You are not accessible for this order page');
		}else{
			$orderAccess = AdminsRole::where(['admin_id'=>Auth::guard('admin')->user()->id,'model'=>'order'])->get()->toArray();
		}
	return view('admin.orders.order')->with(['controller'=>'order', 'orderData'=>$orderData,'page_type'=>'admin_page','orderAccess'=>$orderAccess]);
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
	
	public function ordersView($order_id){
		$totalGST = $this->GSTCalculate();
		$orderView = Order::with('orders_products')->where('id',$order_id)->get()->toArray();
		$billingAddress = User::where('id',$orderView[0]['user_id'])->get()->toArray();
		$Order_status = OrderStatus::select('id','name','status')->get()->toArray();
		$orderLog = OrderLog::where('order_id',$order_id)->get()->toArray();
		return view('admin.orders.order_view')->with(['controller'=>'order','order_status'=>$Order_status,'order_log'=>$orderLog,'billingAddress'=>$billingAddress,'totalGST'=>$totalGST,'orderData'=>$orderView,'page_type'=>'admin_page']);
	}
	
	public function orderStatus(Request $request){
		$data = $request->all();
		$orderStatus = Order::find($data['order_id']);
		//Update tracking no and courier 
		if(!empty($data['tracking_number']) && $data['courier_name']){
			$orderStatus->tracking_number = $data['tracking_number'];
			$orderStatus->courier_name = $data['courier_name'];
		}
		$orderStatus->order_status = $data['order_status'];
		$orderStatus->save();
		
		$orderDetails = Order::with('orders_products')->where('id',$data['order_id'])->get()->toArray();
		$userDetails = User::where('id',$orderDetails[0]['user_id'])->get()->toArray();
		//$orderLog = OrderLog::where('order_id',$data['order_id'])->get()->toArray();
		
		$message = "Dear '".$userDetails[0]['name']."', Your order '".$data['order_id']."' Status has been updated to '".$data['order_status']."'";
		$email = $userDetails[0]['email'];
		$messageData =[
			'email'=>$userDetails[0]['email'],
			'name'=>$userDetails[0]['name'],
			'order_id'=>$data['order_id'],
			'order_status'=>$data['order_status'],
			'orderDetails'=>$orderDetails,
			'tracking_number'=>$data['tracking_number'],
			'courier_name'=>$data['courier_name'],
			'userDetails'=>$userDetails
		];
		Mail::send('front.email.order_status', $messageData, function($message) use($email){
			$message->to($email)->subject('Order Status - E-commerce of Muzaffer!');
		});
		// save the order log
		$Log = new OrderLog;
		$Log->order_id = $data['order_id'];
		$Log->order_status = $data['order_status'];
		$Log->save();
		
		return back()->with('success', 'Your order status updated successfully');
	}
	
	public function ordersViewInvoice($id){
		$orderView = Order::with('orders_products')->where('id',$id)->get()->toArray();
		$billingAddress = User::where('id',$orderView[0]['user_id'])->get()->toArray();

		return view('admin.orders.order_view_invoice')->with(['billingAddress'=>$billingAddress,'orderData'=>$orderView,'controller'=>'order','page_type'=>'admin_page_invoice']);
	}
	
	public function ordersViewPDF($id){
	
		$orderView = Order::with('orders_products')->where('id',$id)->get()->toArray();
		$billingAddress = User::where('id',$orderView[0]['user_id'])->get()->toArray();
		//echo"<pre>";
		//print_r($orderView);
		//die;
		//PDF HTML added
		$HtmlOutPut = '<!DOCTYPE html>
			<html lang="en">
			  <head>
				<meta charset="utf-8">
				<title>Example 2</title>
				<style>
					@font-face {
			  font-family: SourceSansPro;
			  src: url(SourceSansPro-Regular.ttf);
			}

			.clearfix:after {
			  content: "";
			  display: table;
			  clear: both;
			}

			a {
			  color: #0087C3;
			  text-decoration: none;
			}

			body {
			  position: relative;
			  width: 21cm;  
			  height: 29.7cm; 
			  margin: 0 auto; 
			  color: #555555;
			  background: #FFFFFF; 
			  font-family: Arial, sans-serif; 
			  font-size: 14px; 
			  font-family: SourceSansPro;
			}

			header {
			  padding: 10px 0;
			  margin-bottom: 20px;
			  border-bottom: 1px solid #AAAAAA;
			}

			#logo {
			  float: left;
			  margin-top: 8px;
			}

			#logo img {
			  height: 70px;
			}

			#company {
			  float: right;
			  text-align: right;
			}


			#details {
			  margin-bottom: 50px;
			}

			#client {
			  padding-left: 6px;
			  border-left: 6px solid #0087C3;
			  float: left;
			}

			#client .to {
			  color: #777777;
			}

			h2.name {
			  font-size: 1.4em;
			  font-weight: normal;
			  margin: 0;
			}

			#invoice {
			  float: right;
			  text-align: right;
			}

			#invoice h1 {
			  color: #0087C3;
			  font-size: 2.4em;
			  line-height: 1em;
			  font-weight: normal;
			  margin: 0  0 10px 0;
			}

			#invoice .date {
			  font-size: 1.1em;
			  color: #777777;
			}

			table {
			  width: 100%;
			  border-collapse: collapse;
			  border-spacing: 0;
			  margin-bottom: 20px;
			}

			table th,
			table td {
			  padding: 20px;
			  background: #EEEEEE;
			  text-align: center;
			  border-bottom: 1px solid #FFFFFF;
			}

			table th {
			  white-space: nowrap;        
			  font-weight: normal;
			}

			table td {
			  text-align: right;
			}

			table td h3{
			  color: #57B223;
			  font-size: 1.2em;
			  font-weight: normal;
			  margin: 0 0 0.2em 0;
			}

			table .no {
			  color: #FFFFFF;
			  font-size: 1.6em;
			  background: #57B223;
			}

			table .desc {
			  text-align: left;
			}

			table .unit {
			  background: #DDDDDD;
			}

			table .qty {
			}

			table .total {
			  background: #57B223;
			  color: #FFFFFF;
			}

			table td.unit,
			table td.qty,
			table td.total {
			  font-size: 1.2em;
			}

			table tbody tr:last-child td {
			  border: none;
			}

			table tfoot td {
			  padding: 10px 20px;
			  background: #FFFFFF;
			  border-bottom: none;
			  font-size: 1.2em;
			  white-space: nowrap; 
			  border-top: 1px solid #AAAAAA; 
			}

			table tfoot tr:first-child td {
			  border-top: none; 
			}

			table tfoot tr:last-child td {
			  color: #57B223;
			  font-size: 1.4em;
			  border-top: 1px solid #57B223; 

			}

			table tfoot tr td:first-child {
			  border: none;
			}

			#thanks{
			  font-size: 2em;
			  margin-bottom: 50px;
			}

			#notices{
			  padding-left: 6px;
			  border-left: 6px solid #0087C3;  
			}

			#notices .notice {
			  font-size: 1.2em;
			}

			footer {
			  color: #777777;
			  width: 100%;
			  height: 30px;
			  position: absolute;
			  bottom: 0;
			  border-top: 1px solid #AAAAAA;
			  padding: 8px 0;
			  text-align: center;
			}

				</style>
			  </head>
			  <body>
				<header class="clearfix">
				  <div id="logo">
					<h2>ORDER INVOICE</h2>
				  </div>
				  <div style="float:right;">
					<h2 class="name">E-Comm, Muzaffer</h2>
					<div>455 Foggy Heights, AZ 85004, US</div>
					<div>(602) 519-0450</div>
					<div><a href="mailto:company@example.com">e-comm@example.com</a></div>
				  </div>
				  </div>
				</header>
				<main>
				  <div id="details" class="clearfix">
					<div id="client">
					  <div class="to">INVOICE TO:</div>
					  <h2 class="name">'.$orderView[0]['name'].'</h2>
					  <div class="address">'.$orderView[0]['address'].', '.$orderView[0]['city'].','.$orderView[0]['state'].','.$orderView[0]['pincode'].','.$orderView[0]['country'].'</div>
					  <div class="email"><a href="mailto:john@example.com">'.$orderView[0]['email'].'</a></div>
					</div>
					<div id="client" style="float:right">
					  <h3>INVOICE  #'.$orderView[0]['id'].'</h3>
					  <div class="date">Date of Invoice: '.date('d-m-Y', strtotime($orderView[0]['created_at'])).'</div>
					  <div class="date">Due Date: '.date('d-m-Y', strtotime($orderView[0]['updated_at'])).'</div>
					</div>
				  </div>
				  <table border="0" cellspacing="0" cellpadding="0">
					<thead>
					  <tr>
						<th class="no">#</th>
						<th class="desc">DESCRIPTION</th>
						<th class="unit">SIZE</th>
						<th class="desc">COLOR</th>
						<th class="unit">UNIT PRICE</th>
						<th class="qty">QUANTITY</th>
						<th class="total">TOTAL</th>
					  </tr>
					</thead>
					<tbody>';
					foreach($orderView[0]['orders_products'] as $key=>$value){
					   $HtmlOutPut.='<tr>
						<td class="no">'.($key+1).'</td>
						<td class="desc"><h3>'.$value['product_name'].'</h3>'.$value['product_code'].'</td>
						<td class="unit"><h3>'.$value['product_size'].'</td>
						<td class="desc"><h3>'.$value['product_color'].'</td>
						<td class="unit">'.$value['product_price'].'</td>
						<td class="qty">'.$value['product_qty'].'</td>
						<td class="total">'.$value['product_price']*$value['product_qty'].'</td>
					  </tr>';
					}
					  $HtmlOutPut.='</tbody>
					<tfoot>
					  <tr>
						<td colspan="3"></td>
						<td colspan="3">SUBTOTAL</td>
						<td>'.($orderView[0]['grand_total']+$orderView[0]['coupon_amount']).'</td>
					  </tr>
					  <tr>
						<td colspan="3"></td>
						<td colspan="3">Discount</td>
						<td>'.$orderView[0]['coupon_amount'].'</td>
					  </tr>
					  <tr>
						<td colspan="3"></td>
						<td colspan="3">GRAND TOTAL</td>
						<td>'.$orderView[0]['grand_total'].'</td>
					  </tr>
					</tfoot>
				  </table>
				  <div id="thanks">Thank you!</div>
				  <div id="notices">
					<div>NOTICE:</div>
					<div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
				  </div>
				</main>
				<footer>
				  Invoice was created on a computer and is valid without the signature and seal.
				</footer>
			  </body>
			</html>';
		
		//instantiate and use the dompdf class
		$dompdf = new Dompdf();
		$dompdf->loadHtml($HtmlOutPut);

		//(Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'landscape');

		//Render the HTML as PDF
		$dompdf->render();

		//Output the generated PDF to Browser
		$dompdf->stream();
		
	}
	
	public function returnOrder(){
		Session::put('page','return');
		$returnData = ReturnRequest::get()->toArray();
		return view('admin.orders.return_orders')->with(['controller'=>'admin','returnData'=>$returnData,'page_type'=>'admin_page']);
	}
	
	public function returnUpdate(Request $request){	
		$data =$request->all();
		
		$requestCount = ReturnRequest::where(['id'=>$data['request_id'],'user_id'=>$data['user_id'],'order_id'=>$data['order_id'],'product_id'=>$data['product_id'],'product_code'=>$data['product_code']])->count();
		
		if($requestCount >0){
			$ordersProductCount = OrdersProduct::where(['user_id'=>$data['user_id'],'order_id'=>$data['order_id'],'product_id'=>$data['product_id'],'product_code'=>$data['product_code']])->count();
			if($ordersProductCount){
				ReturnRequest::where(['user_id'=>$data['user_id'],'order_id'=>$data['order_id'],'product_id'=>$data['product_id'],'product_code'=>$data['product_code']])->update(['return_status'=>$data['return_status']]);
				OrdersProduct::where(['user_id'=>$data['user_id'],'order_id'=>$data['order_id'],'product_id'=>$data['product_id'],'product_code'=>$data['product_code']])->update(['item_status'=>$data['return_status']]);
				
				$userData = User::select('name','email')->where('id',$data['user_id'])->first()->toArray();
				
				$messageData =[
					'email'=>$userData['email'],
					'name'=>$userData['name'],
					'status'=>$data['return_status'],
					'order_id'=>$data['order_id']
				];
				
				$email = $userData['email'];
				
				Mail::send('front.email.request', $messageData, function($message) use($email){
					$message->to($email)->subject('Return order - E-commerce of Muzaffer!');
				});
				
				return back()->with('success', 'Return status update successfully!');
			}else{
				return back()->with('success', 'Return status not matching order selected product!');
			}
		
		}else{
			return back()->with('success', 'Return status not matching selected product!');
		}
	}
	
	public function exchangeOrder(){
		session::put('page','exchange');
		$exchangeData = ExchangeRequest::get()->toArray();
		return view('admin.orders.exchange_orders')->with(['controller'=>'admin','exchangeData'=>$exchangeData,'page_type'=>'admin_page']);
	}
	
	public function exchangeUpdate(Request $request){
		$data =$request->all();
	
		$exchangeCount = ExchangeRequest::where(['id'=>$data['request_id'],'user_id'=>$data['user_id'],'order_id'=>$data['order_id'],'product_code'=>$data['product_code']])->count();
		
		if($exchangeCount >0){
			$ordersProductCount = OrdersProduct::where(['user_id'=>$data['user_id'],'order_id'=>$data['order_id'],'product_code'=>$data['product_code']])->count();
			
			if($ordersProductCount >0){
				ExchangeRequest::where(['user_id'=>$data['user_id'],'order_id'=>$data['order_id'],'product_code'=>$data['product_code']])->update(['exchange_status'=>$data['exchange_status']]);
				OrdersProduct::where(['user_id'=>$data['user_id'],'order_id'=>$data['order_id'],'product_code'=>$data['product_code']])->update(['item_status'=>$data['exchange_status']]);
				
				$userData = User::select('name','email')->where('id',$data['user_id'])->first()->toArray();
				
				$messageData =[
					'email'=>$userData['email'],
					'name'=>$userData['name'],
					'status'=>$data['exchange_status'],
					'order_id'=>$data['order_id']
				];
				
				$email = $userData['email'];
				
				Mail::send('front.email.exchange', $messageData, function($message) use($email){
					$message->to($email)->subject('Exchange order - E-commerce of Muzaffer!');
				});
				
				return back()->with('success', 'Exchange status update successfully!');
			}else{
				return back()->with('success', 'Exchange status not matching order selected product!');
			}
		
		}else{
			return back()->with('success', 'Exchange status not matching selected product!');
		}
		
	}
	
	public function orderExport(){
		return Excel::download(new OrdersExport, 'orders.xlsx');
	}
}

















