@extends('layouts.admin_layout.admin_design')
@section('content')
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Coupons Table</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Coupons Tables</li>
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
            <div class="card-header">
              <h3 class="card-title">Coupons Table</h3>
			  <div style="float:right; color:#fff"><button type="button" class="btn btn-success"><a style="color:#fff" href="{{url('/admin/coupons/add-edit/')}}">Add Coupons</a></button></div>
            </div>
			
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
                  <th>Id</th>
                  <th>Coupon Code</th>
                  <th>Coupon Type</th>
                  <th>Amount Type</th>
                  <th>Amount</th>
                  <th>Expiry Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
				@foreach($coupon as $coupons)
                <tr>
					<td>{{$coupons['id']}}</td>
					<td>{{$coupons['coupon_code']}}</td>
					<td>{{$coupons['coupon_type']}}</td>
					<td>{{$coupons['amount_type']}}</td>
					<td>{{$coupons['amount']}}</td>
					<td>{{$coupons['expery_date']}}</td>
					
					@if(isset($couponAccess) && $couponAccess[0]['full_access'] =='1')
						<td>
						@if(isset($couponAccess) && $couponAccess[0]['view_access'] =='1')
							@if($coupons['status'] ==1)
							<p class="couponStatus" style="color:green" status-id="{{$coupons['id']}}" status="{{$coupons['status']}}">Active</p>
							@else<p class="couponStatus" style="color:red;" status-id="{{$coupons['id']}}" status="{{$coupons['status']}}">Inactive</p>
							@endif
						@endif
						</td>
						<td>
						@if(isset($couponAccess) && $couponAccess[0]['edit_access'] =='1')
							<a title="Delete" href="{{url('/admin/coupons/delete/'.$coupons['id'])}}"><i class="fa fa-trash-o fa-lg" aria-hidden="true" style="color:red"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<a title="Edit coupons" href="{{url('/admin/coupons/add-edit/'.$coupons['id'])}}"><i class="fa fa-pencil-square fa-lg" aria-hidden="true" style="color:green"></i></a>
						@endif
						</td>
					@endif
					
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