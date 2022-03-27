@extends('layouts.admin_layout.admin_design')
@section('content')
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Order Table</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><p><a class="breadcrumb-item btn btn-primary" href="{{url('admin/export-order')}}">Export Order</a>&nbsp;&nbsp;</p></li>
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Order Tables</li>
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
			<!--
            <div class="card-header">
              <h3 class="card-title">Coupons Table</h3>
			  <div style="float:right; color:#fff"><button type="button" class="btn btn-success"><a style="color:#fff" href="{{url('/admin/coupons/add-edit/')}}">Add Coupons</a></button></div>
            </div> -->
			
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
            <div class="card-body">
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
                  <th>Actions &nbsp;</th>
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
					@if(isset($orderAccess) && $orderAccess[0]['full_access'] =='1')
						<!-- <a title="Delete" href="{{url('/admin/orders/view-delete/'.$order['id'])}}"><i class="fa fa-trash-o fa-lg" aria-hidden="true" style="color:red"></i></a>&nbsp; -->
						<a title="order invoice" href="{{url('/admin/orders/view/'.$order['id'])}}"><i class="fa fa-eye fa-lg" aria-hidden="true" style="color:red"></i></a>&nbsp;
						@if($order['order_status'] =='Shipped' || $order['order_status'] =='Delivered')
						<a title="order invoice" href="{{url('/admin/orders-view-invoice/'.$order['id'])}}"><i class="fa fa-print" aria-hidden="true" style="color:blue"></i></a> &nbsp;
						<a title="Order Pdf" href="{{url('/admin/orders-view-pdf/'.$order['id'])}}"><i class="far fa-file-pdf" aria-hidden="true" style="color:blue"></i></a>
						@endif
					@endif
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