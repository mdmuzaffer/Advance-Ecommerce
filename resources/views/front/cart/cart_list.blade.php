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
			<td colspan="2">{{$items['product']['product_name']}} || {{$items['product']['product_code']}}<br/>Color : {{$items['product']['product_color']}}<br/>Size : {{$items['size']}}</td>
			<td>
			@if(isset($page_type) && $page_type =='checkout_page')
			<span><p>{{$items['quantity']}}</p></span>
			@else
			<div class="input-append" id="demoCustom">
				<input class="span1" name="quantity" style="max-width:34px" placeholder="1" id="appendedInputButtons" size="16" type="text" value="{{$items['quantity']}}">
				<button class="btn ItemUpdate QuantityMinus" type="button" qwt-proId="{{$items['id']}}"><i class="icon-minus"></i></button>
				<button class="btn ItemUpdate QuantityPlus" type="button" qwt-proId="{{$items['id']}}"><i class="icon-plus"></i></button>
				<button class="btn btn-danger Quantitydelete" type="button"><i class="icon-remove icon-white"></i></button>
			</div>
			@endif
			
			</td>
			<?php $productsattrPrice = Cart::ProductsAttrPrice($items['product_id'], $items['size']);?>
			<td>Rs.{{ $productsattrPrice['price']}}</td>
			<!-- <td>Rs.{{ $items['product']['product_discount']}}</td> -->
			<td>Rs.{{ $productsattrPrice['price']* $items['quantity'] * $items['product']['product_discount']/100}}</td>
			<?php $totaldiscount = $totaldiscount + ($productsattrPrice['price']* $items['quantity'] * $items['product']['product_discount']/100); ?>
			<td>Rs. {{ $productsattrPrice['price']* $items['quantity']}}</td>
			<?php $totalPrice = $totalPrice + ($productsattrPrice['price']* $items['quantity']);?>
		</tr>
		@endforeach
		<tr>
		  <td colspan="6" style="text-align:right">Total Price:	</td>
		  <td> Rs.{{$totalPrice}}</td>
		</tr>
		<tr>
		  <td colspan="6" style="text-align:right">Coupon Discount:	</td>
			
			@if(!empty(Session::has('coupon_amount')) && Session::has('coupon_code')) 
			
				@if(Session::get('amount_type') =='Fixed')
					<?php 
					$couponDiscountF = Session::get('coupon_amount');
					Session::put('couponDiscount', $couponDiscountF);
					
					?>
				@endif
			@endif
			
			@if(!empty(Session::has('coupon_amount')) && Session::has('coupon_code'))
			
				@if(Session::get('amount_type') =='Percentage')
					<?php 
						$couponDiscountP = ($totalPrice * Session::get('coupon_amount')/100);
						Session::put('couponDiscount', $couponDiscountP);
					?>
				@endif
			@endif
				
			<td> Rs.@if(Session::has('couponDiscount')){{ Session::get('couponDiscount') }}@else 0.00 @endif</td>
		</tr>
		
		<tr>
			<td colspan="6" style="text-align:right">Gst Charge:</td>
			<td><span class="product_gst">Rs. {{$totalGST}}</span></td>
		</tr>
		<tr>
			<td colspan="6" style="text-align:right">Shipping Charge:</td>
			<td><span class="country_shipCharge">Rs 0.00</span></td>
		</tr>
		<tr>
		  <td colspan="6" style="text-align:right"><strong>TOTAL (Rs.{{$totalPrice}} - Rs.{{$totaldiscount}} - Rs.@if(Session::has('couponDiscount')){{ Session::get('couponDiscount') }}@else 0.00 @endif + Rs @if($totalGST!==0) {{$totalGST}} @else 0.00 @endif + <span class="country_shipCharge">Rs 0.00</span>) =</strong></td>
		  <td class="label label-important" id="totalMount" style="display:block"> <strong> Rs. <?php echo $allTotal = $totalPrice - $totaldiscount - Session::get('couponDiscount') + $totalGST ?></strong></td>
		</tr>
		<input type="hidden" value="{{Session::put('checkoutAmount', $allTotal)}}" id="cartTotal" tot="{{$allTotal}}">
		<input type="hidden" value="" id="delivery_charge" name="delivery_charge">
		<input type="hidden" value="{{$totalGST}}" id="product_gst" name="product_gst">
		</tbody>
	</table>
</div>