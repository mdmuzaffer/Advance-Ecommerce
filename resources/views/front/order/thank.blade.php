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
		<h3>YOUR PRODUCT ORDER REPLACED SUCCESSFULLY</h3>
		<P>REPLACE ODER NO <b>{{Session::get('order_id')}}</b> AND TOTAL AMOUNT <b> {{Session::get('grand_total')}}</b></P>
	</div>
	
	<!--<div><a href="{{url('/')}}" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a></div> -->
</div>

@endsection

<?php 
// delete or forget session order id and amount after show in thank you page
Session::forget('order_id');
Session::forget('grand_total');
session()->forget('coupon_code');
session()->forget('coupon_amount');
session()->forget('amount_type');
session()->forget('delivery_charge');
?>