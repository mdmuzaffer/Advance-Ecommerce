@extends('layouts.front_layout.front')
@section('content')

<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">FAIL </li>
    </ul>
	<h3>FAIL <a href="{{url('/')}}" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>	
	<hr class="soft"/>
	
	<div>
		<h3>YOUR PRODUCT ORDER FAIL TO REPLACE</h3>
		<P>PLEASE TRY AGAIN OR</b>CONTACT WITH<b> developerphp1995@gmail.com</b></P>
	</div>
</div>

@endsection

<?php 
// delete or forget session order id and amount after show in thank you page Session::forget('order_id');
Session::forget('grand_total');
session()->forget('coupon_code');
session()->forget('coupon_amount');
session()->forget('amount_type');
session()->forget('delivery_charge');
?>