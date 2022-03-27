<html>
<head>
	<title></title>
</head>
<body>
	<table style="width:700px;">
		<tr><td>&nbsp;</td></tr>
		<!--<tr><td><img src="{{asset('/admin_images/logo.png')}}"></td></tr> -->
		<tr><td><img src="{{asset('https://visualitynq.com/storage/2021/03/logo.png')}}"></td></tr>
		<tr><td>Hello, {{$name}}</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Thank you for shipping with us. Your order details are below:-</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Order no: {{$order_id}}</td></tr>
		<tr><td>&nbsp;</td></tr>		
		<tr><td>
			<table style="width:95%" cellpadding="5" cellspacing="5" bgcolor="#f7f4f4">
				<tr bgcolor="#cccccc">
					<td>Product Name</td>
					<td>Product Code</td>
					<td>Product Size</td>
					<td>Product Color</td>
					<td>Product Quantity</td>
					<td>Product Price</td>
				</tr>
				@foreach($orderDetails[0]['orders_products'] as $orders)
					<tr>
						<td>{{$orders['product_name']}}</td>
						<td>{{$orders['product_code']}}</td>
						<td>{{$orders['product_size']}}</td>
						<td>{{$orders['product_color']}}</td>
						<td>{{$orders['product_qty']}}</td>
						<td>{{$orders['product_price']}}</td>
					</tr>
				@endforeach
					<tr>
						<td colspan="5" align="right">Shipping Charges</td>
						<td>INR {{$orderDetails[0]['shipping_charges']}}</td>
					</tr>
					<tr>
						<td colspan="5" align="right">Coupon Discount</td>
						<td>INR {{$orderDetails[0]['coupon_amount']}}.00</td>
					</tr>
					<tr>
						<td colspan="5" align="right">Ground Total</td>
						<td>INR {{$orderDetails[0]['grand_total']}}</td>
					</tr>
			</table>
		</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>
			<table>
				<tr>
					<td><strong>Delivery Address:-</strong></td>
				</tr>
				<tr>
					<td>{{$orderDetails[0]['name']}}</td>
				</tr>
				<tr>
					<td>{{$orderDetails[0]['address']}}</td>
				</tr>
				<tr>
					<td>{{$orderDetails[0]['city']}}</td>
				</tr>
				<tr>
					<td>{{$orderDetails[0]['state']}}</td>
				</tr>
				<tr>
					<td>{{$orderDetails[0]['country']}}</td>
				</tr>
				<tr>
					<td>{{$orderDetails[0]['pincode']}}</td>
				</tr>
				<tr>
					<td>{{$orderDetails[0]['mobile']}}</td>
				</tr>
			</table>
		</td></tr>
		<tr><td>&nbsp;</td></tr>	
		<tr><td>For any queries you cant contact us at <a href="mailto:developerphp1995@gmail.com">developerphp1995@gmail.com</a></td></tr>	
		<tr><td>&nbsp;</td></tr>
		<tr><td>Thanks Regard</td></tr>
		<tr><td>E-commerce, Muzaffer</td></tr>	
	</table>
</body>
</html>