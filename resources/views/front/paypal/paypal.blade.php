@extends('layouts.front_layout.front')
@section('content')

<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">Thank </li>
    </ul>
	<h3>Thank You <a href="{{url('/')}}" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>	
	<hr class="soft"/>
	
	<div>
		<h3>YOUR PRODUCT ORDER DETAILS</h3>
		<P>REPLACE ODER NO <b>{{Session::get('order_id')}}</b> AND TOTAL AMOUNT <b> {{Session::get('grand_total')}}</b></P>
	</div>
	
	<!--<div><a href="{{url('/')}}" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a></div> -->
	<div>

			<!-- Using payPal for pament-->
			<form action="https://sandbox.paypal.com/cgi-bin/webscr" method="post">

			  <!-- Saved buttons use the "secure click" command -->
				<input type="hidden" name="cmd" value="_xclick">
			  <!-- Saved buttons are identified by their button IDs -->
				<!--<input type="hidden" name="business" value="developer1994@gmail.com"> -->
				<input type="hidden" name="business" value="sb-r476im6414267@business.example.com">
				<input type="hidden" name="item_name" value="{{Session::get('order_id')}}">
				<input type="hidden" name="item_number" value="{{Session::get('order_id')}}">
				<input type="hidden" name="amount" value="{{Session::get('grand_total')}}">
				<input type="hidden" name="currency_code" value="INR">
				<input type="hidden" name="first_name" value="{{$orderDetails['name']}}">
				<input type="hidden" name="last_name" value="{{$orderDetails['name']}}">
				<input type="hidden" name="email" value="{{$orderDetails['email']}}">
				<input type="hidden" name="address1" value="{{$orderDetails['address']}}">
				<input type="hidden" name="address2" value="{{$orderDetails['address']}}">
				<input type="hidden" name="city" value="{{$orderDetails['city']}}">
				<input type="hidden" name="zip" value="{{$orderDetails['pincode']}}">
				<input type="hidden" name="day_phone_a" value="{{$orderDetails['mobile']}}">
				<input type="hidden" name="night_phone_a" value="{{$orderDetails['mobile']}}">
				<input type="hidden" name="night_phone_a" value="{{$orderDetails['mobile']}}">
				
				<input type="hidden" name="return" value="{{url('/paypal/success')}}">
				<input type="hidden" name="cancel_return" value="{{url('/paypal/fail')}}">

			  <!-- Saved buttons display an appropriate button image. -->
				<input type="image" name="submit"
				src="https://www.paypalobjects.com/en_US/i/btn/btn_paynow_LG.gif"
				alt="PayPal - The safer, easier way to pay online">
				<img alt="" width="1" height="1"
				src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

			</form>
	</div>
	
	
</div>

@endsection

<?php 
// delete or forget session order id and amount after show in thank you page
/* Session::forget('order_id');
Session::forget('grand_total');
session()->forget('coupon_code');
session()->forget('coupon_amount');
session()->forget('amount_type');
session()->forget('delivery_charge'); */
?>