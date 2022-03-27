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
				<h5>FORGOT YOUR PASSWORD</h5><br/>
				Enter your details to create an account.<br/>
				<div style="width:100; margin-left:5px;">
					@if ($message = Session::get('error'))
						<br>
						<div class="alert alert-danger alert-block">
							<button type="button" class="close" data-dismiss="alert">×</button>	
							<strong>{{ $message }}</strong>
						</div>
					@endif
				</div>
				<form action="{{url('forgot-password')}}" method="post" name="forgotPassword" id="forgotPassword">
				@csrf
				
				<div class="control-group">
					<label class="control-label" for="inputEmail0">E-mail</label>
					<div class="controls">
					  <input class="span3" name="email" type="text" id="email" placeholder="Email">
					</div>
				</div>

					  
				  <div class="controls">
				  <button type="submit" class="btn block">Forget password</button>
				  </div>
				  
				</form>
			</div>
		</div>
		<div class="span1"> &nbsp;</div>
		<div class="span4">
			<div class="well">
			
			@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			
			<div style="width:100; margin-left:5px;">
				@if ($message = Session::get('errorlogin'))
					<br>
					<div class="alert alert-danger alert-block">
						<button type="button" class="close" data-dismiss="alert">×</button>	
						<strong>{{ $message }}</strong>
					</div>
				@endif
			</div>
			
			<h5>ALREADY REGISTERED ?</h5>
			<form action="{{url('login')}}" method="post" name="loginForm" id="loginForm">
				@csrf
			  <div class="control-group">
				<label class="control-label" for="loginemail">Email</label>
				<div class="controls">
				  <input class="span3"  type="text" id="loginemail" name="loginemail" placeholder="Email">
				</div>
			  </div>
			  <div class="control-group">
				<label class="control-label" for="loginpassword">Password</label>
				<div class="controls">
				  <input type="password" class="span3"  id="loginpassword" name="loginpassword" placeholder="Password">
				</div>
			  </div>
			  <div class="control-group">
				<div class="controls">
				  <button type="submit" class="btn">Sign in</button> <a href="{{url('/forgot-password')}}">Forget password?</a>
				</div>
			  </div>
			</form>
		</div>
		</div>
	</div>	
	
</div>

@endsection