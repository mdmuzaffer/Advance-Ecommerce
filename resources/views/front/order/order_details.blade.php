@extends('layouts.front_layout.front')
@section('content')
<?php use App\Product;?>
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">Order Details</li>
    </ul>
	
	<h3>ORDERS::#{{$orderDetails['id']}} <button type="button" id="ordercancle" class="btn btn-danger" style="margin-left: 32%;" data-cancleid="{{$orderDetails['id']}}" >Cancel</button> 
		@if($orderDetails['order_status'] =="Shipped")<button type="button" class="btn btn-primary" style="margin-left: 2%;" data-toggle="modal" data-target="#orderreturn{{$orderDetails['orders_products'][0]['product_id']}}" >Return</button> @endif <a href="{{url('/my-orders')}}" class="btn btn-large pull-right"><i class="icon-arrow-left"></i>Back</a></h3>	
	<hr class="soft"/>
	<p id="OrderStatusMsg" class="text-info"></p>
	<div>
		<h3>YOUR PRODUCT ORDERS DETAILS</h3>
	</div>
	
	<div class="row-fluid">
		<div class="span6">
			<table class="table table-bordered">
			<thead>
			  <tr>
				<th colspan="2">Order Details</th>
			  </tr>
			</thead>
			<tbody>
			  <tr>
				<td>Order Date</td>
				<td>{{date('d-m-Y', strtotime($orderDetails['created_at']))}}</}}</td>
			  </tr>
			  <tr>
				<td>Order Status</td>
				<td id="chngStatus">{{$orderDetails['order_status']}}</td>
			  </tr>
			  <tr>
				<td>Order Total</td>
				<td>{{$orderDetails['grand_total']}}</td>
			  </tr>
			  <tr>
				<td>Courier Name</td>
				<td>{{$orderDetails['courier_name']}}</td>
			  </tr>
			  <tr>
				<td>Tracking Number</td>
				<td>{{$orderDetails['tracking_number']}}</td>
			  </tr>
			  <tr>
				<td>Shopping Charge</td>
				<td>{{$orderDetails['shipping_charges']}}</td>
			  </tr>
			  
			  <tr>
				<td>GST Charge</td>
				<td>{{$orderDetails['product_gst']}}</td>
			  </tr>
			  
			  <tr>
				<td>Coupon Code</td>
				<td>{{$orderDetails['coupon_code']}}</td>
			  </tr>
			  
			  <tr>
				<td>Coupon Amount</td>
				<td>{{$orderDetails['coupon_amount']}}</td>
			  </tr>
			  
			  <tr>
				<td>Payment Method</td>
				<td>{{$orderDetails['payment_method']}}</td>
			  </tr>
			  
			</tbody>
		  </table>
		</div>
		<div class="span6">
			<table class="table table-bordered">
			<thead>
			  <tr>
				<th colspan="2">Delivery details</th>
			  </tr>
			</thead>
			<tbody>
			  <tr>
				<td>Name</td>
				<td>{{$orderDetails['name']}}</td>
			  </tr>
			  <tr>
				<td>Address</td>
				<td>{{$orderDetails['address']}}</td>
			  </tr>
			  <tr>
				<td>City</td>
				<td>{{$orderDetails['city']}}</td>
			  </tr>
			  
			  <tr>
				<td>State</td>
				<td>{{$orderDetails['state']}}</td>
			  </tr>
			  
			  <tr>
				<td>Country</td>
				<td>{{$orderDetails['country']}}</td>
			  </tr>
			  
			  <tr>
				<td>Pin Code</td>
				<td>{{$orderDetails['pincode']}}</td>
			  </tr>
			  <tr>
				<td>Mobile</td>
				<td>{{$orderDetails['mobile']}}</td>
			  </tr>
			  
			</tbody>
		  </table>
		</div>
	</div>
	
	
	<div>
		<table class="table table-bordered">
			<thead>
				<tr>
				  <th>Image</th>
				  <th>Product Code</th>
				  <th>Product Name</th>
				  <th>Product Size</th>
				  <th>Product Price</th>
				  <th>Product Color</th>
				  <th>Product Qty</th>
				  <th>Return status</th>
				</tr>
			</thead>
			<tbody>
			@foreach($orderDetails['orders_products'] as $product)
				<tr>
					<td><?php $product_mage = Product::productImage($product['product_id']); ?>
					<a href="{{url('/product/'.$product['product_code'].'/'.$product['product_id'])}}" target="_blank"><img style="width:50px; height:50px;" src="{{asset('/admin_images/product_images/small/'.$product_mage)}}"></a>
					</td>
					<td>{{$product['product_code']}}</td>
					<td>{{$product['product_name']}}</td>
					<td>{{$product['product_size']}}</td>
					<td>{{$product['product_price']}}</td>
					<td>{{$product['product_color']}}</td>
					<td>{{$product['product_qty']}}</td>
					<td>{{$product['item_status']}}</td>
				</tr>
				
			@endforeach
			</tbody>
		</table>
	</div>
	
	
	<div class="container">
  <h2>Modal Example</h2>

  <!-- Modal -->
  <div class="modal fade" id="orderreturn{{$orderDetails['orders_products'][0]['product_id']}}" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Order products return/exchange</h4>
		  <p id="OrdeRreturnMsg"></p>
        </div>
		<form id="product_return_id">
		<input type="hidden" name="order_id" id="order_id" value="{{$orderDetails['id']}}" />
		<input type="hidden" name="old_size" id="old_size" value="{{$product['product_size']}}" />
		<input type="hidden" name="product_id" id="product_id" value="{{$product['product_code']}}-{{$product['product_size']}}-{{$product['product_id']}}" />
		
			<div class="modal-body">
				
				<select id="exchange_productStatus" name="exchange_product">
					<option value="return">Return</option>
					<option value="exchange">Exchange</option>
				</select>

				<br>
				<p></p>
				<select id="product" name="product">
				@foreach($orderDetails['orders_products'] as $product)
				  <option value="{{$product['product_code']}}-{{$product['product_id']}}">{{$product['product_code']}}-{{$product['product_id']}}</option>
				@endforeach
				</select>
			  <p></p>
				<select id="reason" name="reason">
				  <option value="Too late to delivery">Too late to delivery</option>
				  <option value="Product box okay but product damage">Product box okay but product damage</option>
				  <option value="Product box Opened">Product box opened</option>
				  <option value="Product quality is not good">Product quality is not good</option>
				</select>
				<p></p>
				
				<select id="exchangeReturn_product" name="exchangeReturn_product">
				  <option value="">Select size</option>
				  <option value="small">Small</option>
				</select>
				<p></p>
				<textarea name="comment" id="comment" rows="4" cols="50" >Enter your comment...</textarea>
			
			</div>
			
			<div class="modal-footer">
			  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			  <button type="button" class="btn btn-info" id="productReturn">Submit</button>
			</div>
		</form>
		
      </div>
      
    </div>
  </div>
  
</div>
	
	<!-- <div><a href="{{url('/')}}" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a></div> -->
</div>

@endsection

