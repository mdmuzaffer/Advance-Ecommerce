@extends('layouts.admin_layout.admin_design')
@section('content')
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Order view Table</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Order view</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
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
		<!-- view order start-->
		
	  <div class="row">
          <div class="col-md-6">
            <!-- card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Order Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0 table-responsive">
                <table class="table table-sm table-bordered">
                  <thead>
                    <tr>
					  <th style="width: 10px"></th>
                      <th>Details</th>
                      <th>Value</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
					  <td></td>
                      <td>Order Date</td>
                    
                      <td>{{ date('d-m-Y', strtotime($orderData[0]['created_at'])) }}</td>
                    </tr>
					
                    <tr>
					  <td></td>
                      <td>Order State</td>
                      <td>{{$orderData[0]['order_status']}}</td>
                    </tr>
					
					<tr>
					  <td></td>
                      <td>Order Total</td>
                      <td>{{$orderData[0]['grand_total']}}</td>
                    </tr>
					
					<tr>
					  <td></td>
                      <td>Courier Name</td>
                      <td>{{$orderData[0]['courier_name']}}</td>
                    </tr>
					
					<tr>
					  <td></td>
                      <td>Trucking No</td>
                      <td>{{$orderData[0]['tracking_number']}}</td>
                    </tr>
					
					<tr>
					  <td></td>
                      <td>Shipping Change</td>
                      <td>INR {{$orderData[0]['shipping_charges']}}</td>
                    </tr>
					
					<tr>
					  <td></td>
                      <td>GST Charge</td>
                      <td>INR {{$orderData[0]['product_gst']}}</td>
                    </tr>
					<tr>
					  <td></td>
                      <td>Coupon Code</td>
                      <td>{{$orderData[0]['coupon_code']}}</td>
                    </tr>
					<tr>
					  <td></td>
                      <td>Coupon Amount</td>
                      <td>{{$orderData[0]['coupon_amount']}}</td>
                    </tr>
					<tr>
					  <td></td>
                      <td>Payment Method</td>
                      <td>{{$orderData[0]['payment_method']}}</td>
                    </tr>
					<tr>
					  <td></td>
                      <td>Payment Gateway</td>
                      <td>{{$orderData[0]['payment_gatway']}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
			
			            <!-- card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Deliver Address</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0 table-responsive">
                <table class="table table-sm table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px"></th>
                      <th>Details</th>
                      <th>Value</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td></td>
                      <td>Name</td>
                      <td>{{$orderData[0]['name']}}</td>
                    </tr>
					<tr>
                      <td></td>
                      <td>Address</td>
                      <td>{{$orderData[0]['address']}}</td>
                    </tr>
					<tr>
                      <td></td>
                      <td>City</td>
                      <td>{{$orderData[0]['city']}}</td>
                    </tr>
					<tr>
                      <td></td>
                      <td>State</td>
                      <td>{{$orderData[0]['state']}}</td>
                    </tr>
					<tr>
                      <td></td>
                      <td>Country</td>
                      <td>{{$orderData[0]['country']}}</td>
                    </tr>
					<tr>
                      <td></td>
                      <td>Pin Code</td>
                      <td>{{$orderData[0]['pincode']}}</td>
                    </tr>
					<tr>
                      <td></td>
                      <td>Mobile</td>
                      <td>{{$orderData[0]['mobile']}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
			
          </div>
		  
        <!-- /.col -->
        <div class="col-md-6">
		
		
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Customer Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0 table-responsive">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px"></th>
                      <th>Details</th>
                      <th>Value</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td></td>
                      <td>Name</td>
                      <td>{{$orderData[0]['name']}}</td>
                    </tr>
					<tr>
                      <td></td>
                      <td>Email</td>
                      <td>{{$orderData[0]['email']}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
			
			<div class="card">
              <div class="card-header">
                <h3 class="card-title">Billing Address</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0 table-responsive">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px"></th>
                      <th>Details</th>
                      <th>Value</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td></td>
                      <td>Name</td>
                      <td>{{ $billingAddress[0]['name']}}</td>
                    </tr>
					<tr>
                      <td></td>
                      <td>Address</td>
                      <td>{{ $billingAddress[0]['address']}}</td>
                    </tr>
					<tr>
                      <td></td>
                      <td>City</td>
                      <td>{{ $billingAddress[0]['city']}}</td>
                    </tr>
					<tr>
                      <td></td>
                      <td>State</td>
                      <td>{{ $billingAddress[0]['state']}}</td>
                    </tr>
					<tr>
                      <td></td>
                      <td>Country</td>
                      <td>{{ $billingAddress[0]['country']}}</td>
                    </tr>
					<tr>
                      <td></td>
                      <td>Pin code</td>
                      <td>{{ $billingAddress[0]['pincode']}}</td>
                    </tr>
					<tr>
                      <td></td>
                      <td>Mobile</td>
                      <td>{{ $billingAddress[0]['mobile']}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
			  
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
			
            <!-- card -->
			<div class="card">
              <div class="card-header">
                <h3 class="card-title">Update Order Status</h3>
              </div>
			  
			  <form action="{{url('/admin/orders/status')}}" method="post">
				@csrf
				<input type="hidden" name="order_id" value="{{$orderData[0]['id']}}">
				<div class="row">
				
					<div class="col-sm-3">
					  <!-- select -->
					  <div class="form-group" style="margin-left:10px;">
						<label>Order Status</label>
						<select class="form-control" name="order_status" id="order_status">
						@foreach($order_status as $orstatus)
						  <option value="{{$orstatus['name']}}" @if(!empty($orderData[0]['order_status']) && $orderData[0]['order_status'] == $orstatus['name']) selected @endif>{{ $orstatus['name'] }}</option>
						@endforeach
						</select>
					  </div>			  
					</div>
					<div class="col-sm-3" id="courier_name">
					  <!-- select -->
					  <div class="form-group" style="margin-left:10px;">
						<label>Courier name</label>
						<select class="form-control" name="courier_name">
						  <option>Select</option>
						  <option value="Fedex">FedEx</option>
						  <option value="Shiprocket">Shiprocket</option>
						  <option value="Bluedart">Bluedart</option>
						  <option value="XpressBees">XpressBees</option>
						</select>
					  </div>			  
					</div>
					<div class="col-sm-3" id="tracking_number">
					  <!-- select -->
					  <div class="form-group" style="margin-left:10px;">
						<div class="form-group">
							<label for="trucking">Trucking No</label>
							<input type="text" class="form-control" name="tracking_number" placeholder="Trucking">
						</div>
					  </div>			  
					</div>
					
					<div class="col-sm-3">
						<button type="submit" class="btn btn-info" style="margin-top:32px;">Change Status</button>
					</div>
					
					<div class="col-sm-6"></div>
					
				</div>
				</form>
				<div class="row">
					<div class="col-md-12 table-responsive">
					<table class="table table-striped table-bordered">
					  <thead>
						<tr>
						  <th>Order Status</th>
						  <th>Date</th>
						  <th>Courier</th>
						  <th>Tracking</th>
						  
						</tr>
					  </thead>
					  <tbody>
					  @foreach($order_log as $log)
						<tr>
						  <td>{{$log['order_status']}}</td>
						   <td>{{ date('j F,Y,g:i a', strtotime($log['created_at']))}}</td>
						   <td>{{$orderData[0]['courier_name']}}</td>
						   <td>{{$orderData[0]['tracking_number']}}</td>
						</tr>
					  @endforeach
					  </tbody>
					</table>
						
					</div>
				</div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
          <!-- /.col -->
        </div>
	  <!-- view order end-->
	
	
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Order Id</th>
                  <th>Order Date</th>
                  <th>Customer Name</th>
                  <th>Customer Email</th>
                  <th>Ordered Product</th>
				  <th>Ordered Amount</th>
				  <th>Ordered Status</th>
                  <th>Payment Method</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
				@foreach($orderData as $order)
                <tr>
					<td>{{$order['id']}}</td>
					<td>{{date('d-m-y', strtotime($order['created_at']))}}</}}</td>
					<td>{{$order['name']}}</td>
					<td>{{$order['email']}}</td>
					<td>@foreach($order['orders_products'] as $procode) {{$procode['product_code']}} <br>@endforeach</td>
					
					<td>{{$order['grand_total']}}</td>
					<td>{{$order['order_status']}}</td>
					<td>{{$order['payment_method']}}</td>
					<td>
						<a title="Delete" href="{{url('/admin/orders/view-delete/'.$order['id'])}}"><i class="fa fa-trash-o fa-lg" aria-hidden="true" style="color:red"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a title="Edit orders" href="{{url('/admin/orders/view/'.$order['id'])}}"><i class="fa fa-eye fa-lg" aria-hidden="true" style="color:red"></i></a>
					</td>
                </tr>
				
				@endforeach
                </tbody>
              </table>
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