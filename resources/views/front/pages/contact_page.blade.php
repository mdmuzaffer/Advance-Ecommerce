@extends('layouts.front_layout.front')
@section('content')
 
 <div class="span9">
    <ul class="breadcrumb">
		<li><a href="{{url('/')}}">Home</a> <span class="divider">/</span></li>
		<li class="active">{{$title}}</li>
    </ul>
	
	
	<div style="width:500; margin-left:335px;">
		@if ($message = Session::get('success'))
			<br>
			<div class="alert alert-success alert-block">
				<button type="button" class="close" data-dismiss="alert">×</button>	
				<strong>{{ $message }}</strong>
			</div>
		@endif
	</div>
	
		<h3>{{$title}}</h3>
		<hr class="soft">
		
		<div class="row">
			<div class="span4">
			<h4>Contact Details</h4>
			<p>	18 Fresno,<br> CA 93727, USA
				<br><br>
				developerphp1995@gmail.com<br>
				&#xFEFF;Tel 98745-23564<br>
				Fax 00000-00000<br>
				web: https://github.com/mdmuzaffer
			</p>		
			</div>
			
			
		<div class="span4">
		<h4>Email Us</h4><br>
		<form class="form-horizontal" method="post" action="{{url('/page/contact-us')}}">
			@csrf
          <div class="control-group">
              <input type="text" placeholder="name" class="input-xlarge" name="name" required>
          </div>
		   <div class="control-group">
              <input type="email" placeholder="email" class="input-xlarge" name="email" required>
          </div>
		   <div class="control-group">
              <input type="text" placeholder="subject" class="input-xlarge" name="subject">
          </div>
          <div class="control-group">
              <textarea rows="4"  cols="50" placeholder="Your Messages" class="input-xlarge" name="message"></textarea>
           
          </div>

            <button class="btn btn-large" type="submit">Send Messages</button>
			
      </form>
		</div>
			
		</div>
</div>

@endsection