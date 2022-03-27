@extends('layouts.admin_layout.admin_design')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


	    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
		  <div class="col-md-2"></div>
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update details</h3>
              </div>
              <!-- /.card-header -->
			  			  
              <!-- form start -->
			  
			@if ($message = Session::get('success'))
				<br>
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button>	
					<strong>{{ $message }}</strong>
				</div>
			@endif
			  
			  
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
              <form role="form" method="post" action="{{url('/admin/details')}}" enctype="multipart/form-data">
			  @csrf
                <div class="card-body">
					<div class="form-group">
						<label for="exampleInputEmail1">Email</label>
						<input type="text" name="email" class="form-control" id="email" placeholder="Enter email" value="{{Auth::guard('admin')->user()->email}}" readonly>
					</div>
				
					<div class="form-group">
						<div class="adminMessage" style="color:#ef28c2;"></div>
						<label for="exampleInputEmail1">Type</label>
						<input type="text" name="type" class="form-control" id="type" value="{{Auth::guard('admin')->user()->type}}" readonly>
						
					</div>
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" name="name" class="form-control" id="name" value="{{$adminData[0]['name']}}">
					</div>
					<div class="form-group">
						<label for="mobile">Mobile</label>
						<input type="text" name="mobile" class="form-control" id="mobile" value="{{$adminData[0]['mobile']}}">
					</div>
					<div class="form-group">
						<label for="Image">Image</label>
						<input type="file" name="image" class="form-control" id="profile" required accept="image/*">
					</div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
			</div>
		</div>
		<!-- /.card -->
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection