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
			  <th>Discount</th>
			  <th>Sub Total</th>
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
				
				<button class="btn ItemUpdate QuantityMinus" type="button" qwt-proId="{{$items['id']}}"><i class="icon-minus"></i></button>
				<button class="btn ItemUpdate QuantityPlus" type="button" qwt-proId="{{$items['id']}}"><i class="icon-plus"></i></button>
				<button class="btn btn-danger Quantitydelete" type="button"><i class="icon-remove icon-white"></i></button>
			</div>
			@endif
			
		</tr>
		@endforeach
		
		<tr>
		  <td colspan="6" style="text-align:right"><strong>TOTAL (Rs.{{$totalPrice}} - Rs.{{$totaldiscount}} - Rs.@if(Session::has('couponDiscount')){{ Session::get('couponDiscount') }}@else 0.00 @endif + <span class="country_shipCharge">Rs 0.00</span>) =</strong></td>
		  <td class="label label-important" id="totalMount" style="display:block"> <strong> Rs. <?php echo $allTotal = $totalPrice - $totaldiscount - Session::get('couponDiscount')?></strong></td>
		</tr>
		<input type="hidden" value="{{Session::put('checkoutAmount', $allTotal)}}" id="cartTotal" tot="{{$allTotal}}">
		<input type="hidden" value="" id="delivery_charge" name="delivery_charge">
		</tbody>
	</table>
</div>