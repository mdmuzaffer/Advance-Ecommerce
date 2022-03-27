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
                <h3 class="card-title">Change Password</h3>
              </div>
              <!-- /.card-header -->
			  			  
              <!-- form start -->
              <form role="form" method="POST">
			  @csrf
                <div class="card-body">
					<div class="form-group">
						<div class="adminMessage" style="color:#ef28c2;"></div>
						<label for="exampleInputEmail1">Name</label>
						<input type="text" name="username" class="form-control" id="username" value="{{$adminData[0]['name']}}">
						<input type="hidden" name="passswordUrl" id="passswordUrl" value="http://localhost/ecomm/public/admin/password-setting">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Email</label>
						<input type="text" name="email" class="form-control" id="email" placeholder="Enter email" value="{{$adminData[0]['email']}}" readonly>
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Current Password</label>
						<input type="password" name="CurrentPassword" class="form-control" id="CurrentPassword" placeholder="Password">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">New Password</label>
						<input type="password" name="NewPassword" class="form-control" id="NewPassword" placeholder="Enter new password">
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Confirm Password</label>
						<input type="password" name="ConfirmPassword" class="form-control" id="ConfirmPassword" placeholder="Password">
					</div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="button" class="btn btn-primary" onClick="changePwdFunction()">Submit</button>
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