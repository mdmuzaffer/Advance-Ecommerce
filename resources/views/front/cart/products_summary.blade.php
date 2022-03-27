@extends('layouts.front_layout.front')
@section('content')

<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active"> SHOPPING CART</li>
    </ul>
	<h3>  SHOPPING CART [ <small><span class="currentCartItems">{{ totalCartItems() }}</span> Item(s) </small>]<a href="{{url('/')}}" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>	
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
		
	<div id="CartListData">
		@include('front.cart.cart_list')
	
	</div>
		
        <table class="table table-bordered">
			<tbody>
				<tr>
					<td> 
						<div class="showMessage" style="margin-left: 56px; font-size: 16px;"></div>
						<form class="form-horizontal" id="ApplyCoupons" method="post" action="javascript:void(0)">
						<div class="control-group">@csrf
						 @if(Auth::check())<input type="hidden" id="1val" user="1">@endif
						<label class="control-label"><strong>Coupon CODE:</strong></label>
						<div class="controls">
						<input type="text" class="input-medium" placeholder="ENTER COUPON" id="myCoupon" value="">
						<button type="submit" class="btn" id="ApplyCoupon"> Apply </button>
						</div>
						</div>
						</form>
					</td>
                </tr>
				
			</tbody>
		</table>
			
			<table class="table table-bordered">
			 <tr><th>ESTIMATE YOUR SHIPPING </th></tr>
			 <tr> 
			 
			 <td>
			 <div style="color:green;" id="inputCheckpinshow"></div>
				<form class="form-horizontal">
				  <div class="control-group">
				  </div>
				  @csrf
				  <div class="control-group">
				  
					<label class="control-label" for="inputPost">Post Code/ Zipcode </label>
					<div class="controls">
					  <input type="text" id="inputpincheck" placeholder="Postcode">
					</div>
				  </div>
				  <div class="control-group">
					<div class="controls">
					  <button type="button" class="btn" id="checkpinButton">CHECK PIN</button>
					</div>
				  </div>
				</form>				  
			  </td>
			  </tr>
            </table>
			
	<a href="{{url('/')}}" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a>
	<a href="{{url('/check-out')}}" class="btn btn-large pull-right">Next <i class="icon-arrow-right"></i></a>
	
</div>

@endsection