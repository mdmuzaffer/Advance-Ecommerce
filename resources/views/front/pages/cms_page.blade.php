@extends('layouts.front_layout.front')
@section('content')
 
 <div class="span9">
    <ul class="breadcrumb">
		<li><a href="{{url('/')}}">Home</a> <span class="divider">/</span></li>
		<li class="active">{{$pageData['title']}}</li>
    </ul>
	
	<div>
		<h3>{{$pageData['title']}}</h3>
		<hr class="soft">
		<p>{{$pageData['description']}}</p>
	</div>
</div>
 
@endsection