@extends('layouts.admin_layout.admin_design')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add Admin</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Edit</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
	
	
	
	    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
		
			<?php 
			if(isset($adminData['id']) && !empty($adminData['id'])){
				$id = $adminData['id'];
			}else{
				$id = "";
			}
			
			?>
			 <div class="col-md-2"></div>
			 <div class="col-md-7">
            <form role="form" method="post" action="{{url('/admin/role/add-edit/'.$id)}}" enctype="multipart/form-data">
			
			  
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
			
			  @csrf
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" name="name" class="form-control" id="name" value="@if(isset($adminData['name'])){{$adminData['name']}} @else @endif">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Email</label>
						<input type="text" name="email" class="form-control" id="email" placeholder="Enter email" value="@if(isset($adminData['email'])){{$adminData['email']}} @else @endif" >
					</div>
					
					<div class="form-group">
						<label>Admin Type</label>
						<select class="form-control" name="type" id="type">
						  <option>Select</option>
						  <option value="admin" @if(!empty($adminData['type']) && $adminData['type'] == 'admin') selected @endif>Admin</option>
						  <option value="superadmin" @if(!empty($adminData['type']) && $adminData['type'] == 'superadmin') selected @endif>Super admin</option>
						  <option value="subadmin" @if(!empty($adminData['type']) && $adminData['type'] == 'subadmin') selected @endif>Sub Admin</option>
						</select>
					  </div>
					
					<div class="form-group">
						<label for="exampleInputPassword1">Password</label>
						<input type="password" name="password" class="form-control" id="password" placeholder="Password" value="@if(isset($adminData['password'])){{$adminData['password']}} @else @endif">
					</div>
					<div class="form-group">
						<label for="mobile">Mobile</label>
						<input type="text" name="mobile" class="form-control" id="mobile" value="@if(isset($adminData['mobile'])){{$adminData['mobile']}} @else @endif">
					</div>
					<div class="form-group">
						<label for="Image">Image</label>
						<input type="file" name="image" class="form-control" id="profile" accept="image/*">
					</div>
					
					
                <div class="card-footer1">
                  <button type="submit" class="btn btn-primary">{{ $button}}</button>
                </div>
                </div>
			
				<!-- /.card-body -->
              </form>
			
			</div><!-- /.col -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>


  </div>
  <!-- /.content-wrapper -->
@endsection