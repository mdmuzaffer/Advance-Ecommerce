@extends('layouts.admin_layout.admin_design')
@section('content')
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users Tables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <a href="{{url('admin/export-users')}}"><button type="button" class="btn btn-primary">Export</button></a> &nbsp;
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users Tables</li>
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
              <h3 class="card-title">Users Table</h3>
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
              <table id="example3" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>State</th>
                  <th>Pin code</th>
                  <th>Mobile</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
				@foreach($users as $user)
                <tr>
					<td>{{$user['id']}}</td>
					<td>{{$user['name']}}</td>
					<td>{{$user['email']}}</td>
					<td>{{$user['address']}}</td>
					<td>{{$user['state']}}</td>
					<td>{{$user['pincode']}}</td>
					<td>{{$user['mobile']}}</td>
					<td>@if($user['status'] ==1) 
						<a href="{{url('/admin/users/status/'.$user['id'])}}" class="userUpdateStatus" id="user-{{$user['id']}}" status-id="{{$user['id']}}" status="{{$user['status']}}">Active</a>
						@else
						<a href="{{url('/admin/users/status/'.$user['id'])}}" style="color:red;" class="userUpdateStatus" id="user-{{$user['id']}}" status-id="{{$user['id']}}" status="{{$user['status']}}">Inactive</a>
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