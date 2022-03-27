@extends('layouts.admin_layout.admin_design')
@section('content')
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admin Tables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
				
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Admin Tables</li>
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
              <h3 class="card-title">Add Admin/Sub Admin</h3>
			  <div style="float:right; color:#fff"><button type="button" class="btn btn-success"><a style="color:#fff" href="{{url('/admin/role/add-edit/')}}">Add Admin/Sub Admin</a></button></div>
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
                  <th>TYpe</th>
                  <th>Status</th>
				  <th>Action</th>
                </tr>
                </thead>
                <tbody>
				@foreach($adminData as $user)
                <tr>
					<td>{{$user['id']}}</td>
					<td>{{$user['name']}}</td>
					<td>{{$user['email']}}</td>
					<td>{{$user['type']}}</td>
					<td>
					@if($user['type'] !=="superadmin" || $user['type']=="admin")
					
						@if($user['status'] ==1) 
							<a href="{{url('/admin/role/status/'.$user['id'])}}" class="userUpdateStatus" id="user-{{$user['id']}}" status-id="{{$user['id']}}" status="{{$user['status']}}">Active</a>
							@else
							<a href="{{url('/admin/role/status/'.$user['id'])}}" style="color:red;" class="userUpdateStatus" id="user-{{$user['id']}}" status-id="{{$user['id']}}" status="{{$user['status']}}">Inactive</a>
						@endif
						
					@endif
					</td>
					<td>
					@if($user['type'] !=="superadmin" || $user['type']=="admin")
						<a title="Permission" href="{{url('/admin/role/permission/'.$user['id'])}}"><i class="fa fa-lock" style="font-size:20px"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a title="Delete" href="{{url('/admin/role/delete/'.$user['id'])}}"><i class="fa fa-trash-o fa-lg" aria-hidden="true" style="color:red"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a title="Edit coupons" href="{{url('/admin/role/add-edit/'.$user['id'])}}"><i class="fa fa-pencil-square fa-lg" aria-hidden="true" style="color:green"></i></a>
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