@extends('layouts.admin_layout.admin_design')
@section('content')
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Order View Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Order View Invoice</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
			
				@if ($message = Session::get('success'))
					<br>
					<div class="alert alert-success alert-block" style="width:400px">
						<button type="button" class="close" data-dismiss="alert">×</button>	
						<strong>{{ $message }}</strong>
					</div>
				@endif
				
				@if (count($errors) > 0)
					<div class = "alert alert-danger">
						<ul>
						   @foreach ($errors->all() as $error)
							  <li>{{ $error }}</li>
						   @endforeach
						</ul>
					</div>
				@endif
			
            <!-- /.card-header -->
           
					<div class="col-xs-12">
						<div class="invoice-title">
							<h2>Invoice</h2><h3 class="pull-right">Order # {{$orderData[0]['id']}}</h3>
							<p></p><p class="pull-right"><?php echo DNS1D::getBarcodeSVG($orderData[0]['id'], 'C39');?></p><br>
							
						</div>
						<hr>
						<div class="row">
							<div class="col-xs-6">
								<address>
								<strong>Billed To:</strong><br>
									{{$orderData[0]['name']}}<br>
									{{$orderData[0]['address']}}<br>
									{{$orderData[0]['city']}}<br>
									{{$orderData[0]['state']}}<br>
									{{$orderData[0]['country']}}<br>
									{{$orderData[0]['mobile']}}, {{$orderData[0]['pincode']}}
								</address>
							</div>
							<div class="col-xs-6 text-right">
								<address>
								<strong>Shipped To:</strong><br>
									{{$billingAddress[0]['name']}}<br>
									{{$billingAddress[0]['address']}}<br>
									{{$billingAddress[0]['city']}}<br>
									{{$billingAddress[0]['state']}}<br>
									{{$billingAddress[0]['country']}}<br>
									{{$billingAddress[0]['mobile']}}, {{$billingAddress[0]['pincode']}}
								</address>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<address>
									<strong>Payment Method:</strong><br>
									{{$orderData[0]['payment_method']}}<br>
								</address>
							</div>
							<div class="col-xs-6 text-right">
								<address>
									<strong>Order Date:</strong><br>
									{{date('j, M Y', strtotime($orderData[0]['created_at']))}}<br><br>
								</address>
							</div>
						</div>
					</div>

					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title"><strong>Order summary</strong></h3>
							</div>
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table table-condensed">
										<thead>
											<tr>
												<td><strong>Item</strong></td>
												<td class="text-center"><strong>Price</strong></td>
												<td class="text-center"><strong>Quantity</strong></td>
												<td class="text-right"><strong>Totals</strong></td>
											</tr>
										</thead>
										<tbody>
											<!-- foreach ($order->lineItems as $line) or some such thing here -->
											@foreach($orderData[0]['orders_products'] as $product)
											<tr>
												<td>{{$product['product_code']}}</td>
												<td class="text-center">INR, {{$product['product_price']}}</td>
												<td class="text-center">{{$product['product_qty']}}</td>
												<td class="text-right">INR, {{$product['product_price']*$product['product_qty']}}</td>
											</tr>
											@endforeach
											
											<tr>
												<td class="thick-line"></td>
												<td class="thick-line"></td>
												<td class="thick-line text-center"><strong>Subtotal</strong></td>
												<td class="thick-line text-right">INR, {{$orderData[0]['grand_total'] + $orderData[0]['coupon_amount']}}</td>
											</tr>
											<tr>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line text-center"><strong>Coupon</strong></td>
												<td class="no-line text-right">INR, {{$orderData[0]['coupon_amount']}}</td>
											</tr>
											<tr>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line text-center"><strong>Shipping</strong></td>
												<td class="no-line text-right">INR, {{$orderData[0]['shipping_charges']}}</td>
											</tr>
											
											<tr>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line text-center"><strong>GST Charge</strong></td>
												<td class="no-line text-right">INR, {{$orderData[0]['product_gst']}}</td>
											</tr>
											<tr>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line text-center"><strong>Total</strong></td>
												<td class="no-line text-right">INR, {{$orderData[0]['grand_total']}}</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
			
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
@endsection