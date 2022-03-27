@extends('layouts.front_layout.front')
@section('content')

		<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">Address</li>
    </ul>
	<h3> Address details</h3>	
	<hr class="soft"/>
	
	<div class="row">
	
	<div style="width:500px; margin-left:200px;">
		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
	</div>
		<div class="span4">
			<div class="well">
			
			<div style="width:500; margin-left:5px;">
				@if ($message = Session::get('success'))
					<br>
					<div class="alert alert-success alert-block">
						<button type="button" class="close" data-dismiss="alert">×</button>	
						<strong>{{ $message }}</strong>
					</div>
				@endif
			</div>
				<h5>{{@$title}}</h5><br/>
				<div style="width:100; margin-left:5px;">
					@if ($message = Session::get('error'))
						<br>
						<div class="alert alert-danger alert-block">
							<button type="button" class="close" data-dismiss="alert">×</button>	
							<strong>{{ $message }}</strong>
						</div>
					@endif
					
				<?php 
				if(!empty($deliveryAdd['0']['user_id'])){
					$id = $deliveryAdd['0']['user_id'];
				}else{
					$id ="";
				}
				?>
					
				</div>
				<form action="{{url('/add-edit-delivery-address/'.$id)}}" method="post" name="myaccountForm" id="myaccountForm">
				@csrf
				
				<div class="control-group">
					<label class="control-label" for="name">Name</label>
					<div class="controls">
					  <input class="span3" name="name" type="text" id="name" placeholder="First Name" @if(isset($deliveryAdd['0']['name'])) value="{{ $deliveryAdd['0']['name'] }}" @endif>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="name">Address</label>
					<div class="controls">
					  <input class="span3" name="address" type="text" id="address" placeholder="Address" value="@if(!empty($deliveryAdd['0']['user_id'])){{ $deliveryAdd['0']['address']}} @endif">
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="name">City</label>
					<div class="controls">
					  <input class="span3" name="city" type="text" id="city" placeholder="City" value="@if(!empty($deliveryAdd['0']['user_id'])){{ $deliveryAdd['0']['city']}} @endif">
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="name">State</label>
					<div class="controls">
						<select id="state" name="state" style="text-transform:lowercase;">
							<option value="">Select</option>
							@foreach($state as $sts)
								<option value="{{$sts['state']}}" @if($sts['state'] == Auth::user()->state) selected @endif >{{$sts['state']}}</option>
							@endforeach
						</select>
					  
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="country">Country</label>
					<div class="controls">
						<select id="country" name="country">
							<option value="">Select</option>
							@foreach($country as $county)
								<option value="{{$county['nicename']}}" @if($county['nicename'] == Auth::user()->country) selected @endif >{{$county['nicename']}}</option>
							@endforeach
						</select>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="name">Pin Code</label>
					<div class="controls">
					  <input class="span3" name="pin" type="text" id="pin" placeholder="Pin Code" value="@if(!empty($deliveryAdd['0']['user_id'])){{ $deliveryAdd['0']['pincode']}} @endif">
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="mobile">Mobile</label>
					<div class="controls">
					  <input class="span3" type="text" name="mobile" id="mobile" placeholder="Mobile Phone" value="@if(!empty($deliveryAdd['0']['user_id'])){{ $deliveryAdd['0']['mobile']}} @endif"> 
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="inputEmail0">E-mail</label>
					<div class="controls">
					  <input class="span3" name="email" type="text" id="email" value="{{Auth::user()->email}}" readonly="">
					</div>
				</div>
					  
				  <div class="controls">
				  <button type="submit" class="btn block">Update Your Account</button>
				  </div>
				  
				</form>
			</div>
		</div>
		
	</div>	
	
</div>

@endsection