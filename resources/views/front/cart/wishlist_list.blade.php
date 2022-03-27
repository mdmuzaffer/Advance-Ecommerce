<?php
 use App\Cart;
?>
<div id="addDynamic">
	<table class="table table-bordered">
		<thead>
			<tr>
			  <th>Product</th>
			  <th colspan="2">Description</th>
			  <th>Quantity/Update</th>
			  <th>MRP</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$totalPrice =0;
		$totaldiscount =0;
		?>
		@foreach($cartItems as $items)
		<tr>
			<td> <img width="60" src="{{asset('/admin_images/product_images/small/'.$items['product']['main_image'])}}" alt=""/></td>
			<td colspan="2">{{$items['product']['product_name']}} || {{$items['product']['product_code']}}<br/>Color : {{$items['product']['product_color']}}</td>
			<td>
			@if(isset($page_type) && $page_type =='checkout_page')
			<span><p>{{$items['quantity']}}</p></span>
			@else
			<div class="input-append" id="demoCustom">
				
				<button class="btn" type="button"><a href="{{ url("/product/".$items['product']['product_code']."/".$items['product']['id']) }}"><i class="icon-eye">View </i>&nbsp;&nbsp;&nbsp;</a></button>
				<button class="btn btn-danger WishListdelete" data-proId="{{$items['id']}}" type="button"><i class="icon-remove icon-white"></i></button>
			</div>
			@endif
			</td>
			<td>Rs. {{$items['product']['product_price']}}</td>
			
		</tr>
		@endforeach
		
		</tbody>
	</table>
</div>