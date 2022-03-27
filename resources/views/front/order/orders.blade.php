@extends('layouts.front_layout.front')
@section('content')

<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">Orders </li>
    </ul>
	<h3>ORDERS <a href="{{url('/')}}" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>	
	<hr class="soft"/>
	
	<div>
		<h3>YOUR PRODUCT ORDERS</h3>
	</div>
	<div>
		<table class="table table-bordered">
			<thead>
				<tr>
				  <th>Order ID</th>
				  <th>Order Products</th>
				  <th>Payment Method</th>
				  <th>Grand Total</th>
				  <th>Created On</th>
				  <th>Order Details</th>
				</tr>
			</thead>
			<tbody>
			@foreach($orders as $order)
				<tr>
					<td><a style="text-decoration:underline;" href="{{url('/order-details/'.$order['id'])}}">#{{$order['id']}}</a></td>
					<td>@foreach($order['orders_products'] as $pro)
						{{$pro['product_code']}} <br>
						@endforeach
					</td>
					<td>{{$order['payment_method']}}</td>
					<td>{{$order['grand_total']}}</td>
					<td>{{ date('d-m-Y', strtotime($order['created_at']))}}</td>
					<td><a style="text-decoration:underline;" href="{{url('/order-details/'.$order['id'])}}">Order Details</a></td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
	
	
	<!-- <div><a href="{{url('/')}}" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a></div> -->
</div>

@endsection

