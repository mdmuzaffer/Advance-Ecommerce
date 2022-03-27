@extends('layouts.front_layout.front')
@section('content')

<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">Check Out </li>
    </ul>
	<h3> Check Out [ <small><span class="currentCartItems">{{ totalCartItems() }}</span> Item(s) </small>]<a href="{{url('/')}}" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>	
	<hr class="soft"/>

	<div style="width:500; margin-left:335px;">
		@if ($message = Session::get('success'))
			<br>
			<div class="alert alert-success alert-block">
				<button type="button" class="close" data-dismiss="alert">×</button>	
				<strong>{{ $message }}</strong>
			</div>
		@endif
	</div>	
	<!-- Check out form start-->
	<form method="post" action="{{url('/check-out')}}" class="form-horizontal">
	@csrf
	
	<div id="CartListData">
		@include('front.cart.cart_list')
	
	</div>
        <table class="table table-bordered">
		<tr><th>SHIPPING ADDRESS <p><a class="btn btn-info" style="float:right;" href="{{url('/add-edit-delivery-address/'.@$deliveryAddress[0]['user_id'])}}">ADD ADDRESS</a></p></th></tr>
			<tbody>
			@foreach($deliveryAddress as $deliAddress)
				<tr>
					<td> <input type="radio" id="address" class="useraddress" name="useraddress" checkPincode="{{ $deliAddress['pincode']}}" value="{{ $deliAddress['user_id'] }}-de"> &nbsp; {{ $deliAddress['address'] }}, {{$deliAddress['city']}},{{ $deliAddress['state'] }},{{ $deliAddress['country'] }} - {{ $deliAddress['pincode']}}, Mob:- {{ $deliAddress['mobile']}}  <span style="float:right"><a class="btn btn-info" href="{{url('/add-edit-delivery-address/'.@$deliAddress['user_id'])}}">Edit</a> <a class="btn btn-danger" href="{{url('/delete-delivery-address/'.@$deliAddress['id'])}}">Delete</a></span></td>
                </tr>
			@endforeach
			@if(!empty($userAddress))
				@foreach($userAddress as $userAdd)
					<tr>
						<td> <input type="radio" id="useraddress" class="useraddress" name="useraddress" checkPincode="{{ $userAdd['pincode']}}" value="{{ $userAdd['id'] }}-us"> &nbsp; {{ $userAdd['address'] }}, {{$userAdd['city']}},{{ $userAdd['state'] }},{{ $userAdd['country'] }} - {{ $userAdd['pincode']}}, Mob:- {{ $userAdd['mobile']}}  <span style="float:right"><a class="btn btn-primary" href="{{url('/my-account/')}}">Edit</a></span></td>
					</tr>
				@endforeach
			@endif
			</tbody>
		</table>
			
			<table class="table table-bordered">
			 <tr><th>SHIPPING METHOD </th></tr>
			 <tr><th><p class="shipping_msg text-info"></p></th></tr>
			 <tr id="shippingMethod"> 
				<td>
					<input type="hidden" name="checkoutToata" id="checkoutToata" value="{{Session::get('checkoutAmount')}}">
					<div class="container">
						<p>Please select your payment method:</p>
						<label class="radio-inline"><input type="radio" name="payment" value="COD"> COD</label>
						<label class="radio-inline"><input type="radio" name="payment" value="PayPal"> PayPal</label>
						<label class="radio-inline"><input type="radio" name="payment" value="PayUmoney"> Payu Money</label>
					</div>		  
				</td>
			</tr>
            </table>
			<a href="{{url('/')}}" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a>
			<input type="submit" class="btn btn-primary btn-large pull-right" value="check out">
	
	<!-- Check out form end-->
	</form>
	
</div>

@endsection