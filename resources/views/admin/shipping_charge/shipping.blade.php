@extends('layouts.admin_layout.admin_design')
@section('content')
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Shipping Table</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Shipping Charge</li>
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
                  <th>Country</th>
                  <th>0_500g</th>
                  <th>501_1000g</th>
                  <th>1001_2000g</th>
                  <th>20001_5000g</th>
                  <th>above_5000g</th>
                  <th>Status</th>
				  <th>Updated</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
				@foreach($shippingCharge as $charge)
                <tr>
					<td>{{$charge['id']}}</td>
					<td>{{$charge['country']}}</td>
					<td>{{$charge['0_500g']}}</td>
					<td>{{$charge['501_1000g']}}</td>
					<td>{{$charge['1001_2000g']}}</td>
					<td>{{$charge['20001_5000g']}}</td>
					<td>{{$charge['above_5000g']}}</td>
					<td>
					@if($charge['status'] ==1)
					<i class="fas fa-toggle-on text-success" OnClick="shippingStatus({{$charge['id']}})"></i>
					@else
					<i class="fas fa-toggle-off text-danger" OnClick="shippingStatus({{$charge['id']}})"></i>
					@endif
					</td>
					<td>{{date('Y-m-d', strtotime($charge['created_at']))}}</td>
					<td><a href="{{url('/admin/shipping-charge-update/'.$charge['id'])}}"><i class="fas fa-edit"></i></a></td>

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