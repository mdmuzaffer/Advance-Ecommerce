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
	
	<div>

		<form method="post" name="redirect" action="{{ $endPoint }}">
        <input type=hidden name="key" value="{{ $parameters['key'] }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type=hidden name="hash" value="{{ $hash }}">
        <input type=hidden name="txnid" value="{{ $parameters['txnid'] }}">
        <input type=hidden name="amount" value="{{ $parameters['amount'] }}">
        <input type=hidden name="firstname" value="{{ $parameters['firstname'] }}">
        <input type=hidden name="email" value="{{ $parameters['email'] }}">
        <input type=hidden name="phone" value="{{ $parameters['phone'] }}">
        <input type=hidden name="productinfo" value="{{ $parameters['productinfo'] }}">
        <input type=hidden name="surl" value="{{ $parameters['surl'] }}">
        <input type=hidden name="furl" value="{{ $parameters['furl'] }}">
        <input type=hidden name="service_provider" value="{{ $parameters['service_provider'] }}">

        <input type=hidden name="lastname" value="{{ isset($parameters['lastname']) ? $parameters['lastname']  : '' }}">
        <input type=hidden name="curl" value="{{ isset($parameters['curl']) ? $parameters['curl']  : '' }}">
        <input type=hidden name="address1" value="{{ isset($parameters['address1']) ?  $parameters['address1'] : '' }}">
        <input type=hidden name="address2" value="{{ isset($parameters['address2']) ?  $parameters['address2'] : '' }}">
        <input type=hidden name="city" value="{{ isset($parameters['city']) ?  $parameters['city'] : '' }}">
        <input type=hidden name="state" value="{{ isset($parameters['state']) ?  $parameters['state'] : '' }}">
        <input type=hidden name="country" value="{{ isset($parameters['country']) ? $parameters['country']  : '' }}">
        <input type=hidden name="zipcode" value="{{ isset($parameters['zipcode']) ?  $parameters['zipcode'] : '' }}">
        <input type=hidden name="pg" value="{{ isset($parameters['pg']) ? $parameters['pg']  : '' }}">
    </form>
	<script language='javascript'>document.redirect.submit();</script>
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