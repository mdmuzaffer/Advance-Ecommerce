@extends('layouts.front_layout.front')
@section('content')

		<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">Login</li>
    </ul>
	<h3> Login</h3>	
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
				<h5>CONTACT DETAILS</h5><br/>
				<div style="width:100; margin-left:5px;">
					@if ($message = Session::get('error'))
						<br>
						<div class="alert alert-danger alert-block">
							<button type="button" class="close" data-dismiss="alert">×</button>	
							<strong>{{ $message }}</strong>
						</div>
					@endif
					
				</div>
				<form action="{{url('/my-account')}}" method="post" name="myaccountForm" id="myaccountForm">
				@csrf
				
				<div class="control-group">
					<label class="control-label" for="name">Name</label>
					<div class="controls">
					  <input class="span3" name="name" type="text" id="name" placeholder="First Name" value="{{Auth::user()->name}}">
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="name">Address</label>
					<div class="controls">
					  <input class="span3" name="address" type="text" id="address" placeholder="Address" value="{{Auth::user()->address}}">
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="name">City</label>
					<div class="controls">
					  <input class="span3" name="city" type="text" id="city" placeholder="City" value="{{Auth::user()->city}}">
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
					  <input class="span3" name="pin" type="text" id="pin" placeholder="Pin Code" value="{{Auth::user()->pincode}}">
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="mobile">Mobile</label>
					<div class="controls">
					  <input class="span3" type="text" name="mobile" id="mobile" placeholder="Mobile Phone" value="{{Auth::user()->mobile }}"> 
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
		<div class="span1"> &nbsp;</div>
		<div class="span4">
			<div class="well">
			
			<div style="width:100; margin-left:5px;">
				@if ($message = Session::get('errorpwd'))
					<br>
					<div class="alert alert-danger alert-block">
						<button type="button" class="close" data-dismiss="alert">×</button>	
						<strong>{{ $message }}</strong>
					</div>
				@endif
			</div>
			<div style="width:500; margin-left:5px;">
				@if ($message = Session::get('successpwd'))
					<br>
					<div class="alert alert-success alert-block">
						<button type="button" class="close" data-dismiss="alert">×</button>	
						<strong>{{ $message }}</strong>
					</div>
				@endif
			</div>
			
			<h5>Password Change ?</h5>
			<form action="{{url('password-change')}}" method="post" name="pwdForm" id="pwdForm">
				@csrf
			    <div class="control-group">
					<label class="control-label" for="loginpassword">Password</label>
					<div class="controls">
					  <input type="password" class="span3"  id="password" name="password" placeholder="Password">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="loginpassword">New Password</label>
					<div class="controls">
					  <input type="password" class="span3"  id="newpassword" name="newpassword" placeholder="New Password">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="loginpassword">Confirm Password</label>
					<div class="controls">
					  <input type="password" class="span3"  id="confirmpassword" name="confirmpassword" placeholder="Confirm Password">
					</div>
				</div>
			  <div class="control-group">
				<div class="controls">
				  <button type="submit" class="btn">Update</button> <a href="{{url('/forgot-password')}}">Forget password?</a>
				</div>
			  </div>
			</form>
		</div>
		</div>
	</div>	
	
</div>

@endsection