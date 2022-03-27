@extends('layouts.admin_layout.admin_design')
@section('content')
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Banner Table</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Banner Tables</li>
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
              <h3 class="card-title">Banner Table</h3>
			  <div style="float:right; color:#fff"><button type="button" class="btn btn-success"><a style="color:#fff" href="{{url('/admin/banners/add-edit/')}}">Add Banner</a></button></div>
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
                  <th>Image</th>
                  <th>Title</th>
                  <th>Alt</th>
                  <th>Links</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
				@foreach($banners as $banner)
                <tr>
					<td>{{$banner['id']}}</td>
					<td><img style="width:60px; height:50px;" src="{{asset('/admin_images/banner_images/'.$banner['image'])}}"></td>
					<td>{{$banner['title']}}</td>
					<td>{{$banner['alt']}}</td>
					<td>{{$banner['links']}}</td>
					<td>@if($banner['status'] ==1) 
						<a href="{{url('/admin/banners/status/'.$banner['id'])}}" class="bannerUpdateStatus" id="banner-{{$banner['id']}}" status-id="{{$banner['id']}}" status="{{$banner['id']}}">Active</a>
						@else
						<a href="{{url('/admin/banners/status/'.$banner['id'])}}" style="color:red;" class="bannerUpdateStatus" id="banner-{{$banner['id']}}" status-id="{{$banner['id']}}" status="{{$banner['status']}}">Inactive</a>
						@endif
					</td>
					<td>
						<a title="Delete" href="{{url('/admin/banners/delete/'.$banner['id'])}}"><i class="fa fa-trash-o fa-lg" aria-hidden="true" style="color:red"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a title="Add/Edit banners" href="{{url('/admin/banners/add-edit/'.$banner['id'])}}"><i class="fa fa-pencil-square fa-lg" aria-hidden="true" style="color:green"></i></a>
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