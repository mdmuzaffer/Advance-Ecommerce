@extends('layouts.front_layout.front')
@section('content')

<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">Wishlist </li>
    </ul>
	<h3> Wishlist [ <small><span class="currentCartItems">{{ totalCartItems() }}</span> Item(s) </small>]<a href="{{url('/')}}" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>	
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
	
	@csrf
	
	<div id="wishListData">
		@include('front.cart.wishlist_list')
	
	</div>

	<!-- Check out form end-->

	
</div>

@endsection