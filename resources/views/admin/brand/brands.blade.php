@extends('layouts.admin_layout.admin_design')
@section('content')
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Brand Tables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Brand Tables</li>
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
              <h3 class="card-title">Brand Table</h3>
			  <div style="float:right; color:#fff"><button type="button" class="btn btn-success"><a style="color:#fff" href="{{url('/admin/brands/add-edit/')}}">Add Brand</a></button></div>
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
                  <th>Name</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
				@foreach($brands as $brand)
                <tr>
					<td>{{$brand->id}}</td>
					<td>{{$brand->name}}</td>
					<td>@if($brand->status ==1) 
						<a href="{{url('/admin/brands/status/'.$brand->id)}}" class="brandUpdateStatus" id="section-{{$brand->id}}" status-id="{{$brand->id}}" status="{{$brand->status}}">Active</a>
						@else
						<a href="{{url('/admin/brands/status/'.$brand->id)}}" style="color:red;" class="brandUpdateStatus" id="section-{{$brand->id}}" status-id="{{$brand->id}}" status="{{$brand->status}}">Inactive</a>
						@endif
					</td>
					<td>
						<a title="Delete" href="{{url('/admin/brands/delete/'.$brand->id)}}"><i class="fa fa-trash-o fa-lg" aria-hidden="true" style="color:red"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a title="Add/Edit Product" href="{{url('/admin/brands/add-edit/'.$brand->id)}}"><i class="fa fa-pencil-square fa-lg" aria-hidden="true" style="color:green"></i></a>
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