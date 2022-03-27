@extends('layouts.admin_layout.admin_design')
@section('content')
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>CMS</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Cms Pages</li>
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
              <h3 class="card-title">Cms Pages</h3>
              <button class="btn btn-info float-right"><a style="color:#fff;" href="{{url('admin/add-edit-cms-page/')}}">Add Cms</a></button>
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
              <table id="cmsPage" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Title</th>
                  <th>Url</th>
                  <th>Created</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
				@foreach($cmsPages as $cms)
                <tr>
					<td>{{$cms['id']}}</td>
					<td>{{$cms['title']}}</td>
					<td>{{$cms['url']}}</td>
					<td>{{ date('d-m-Y', strtotime($cms['created_at']))}}</td>
					<td>@if($cms['status'] ==1) 
						<a href="javascript:void(0)" class="cmsUpdateStatus" id="cms-{{$cms['id']}}" status-id="{{$cms['id']}}" status="{{$cms['status']}}">Active</a>
						@else
						<a href="javascript:void(0)" style="color:red;" class="cmsUpdateStatus" id="cms-{{$cms['id']}}" status-id="{{$cms['id']}}" status="{{$cms['status']}}">Inactive</a>
						@endif
					</td>
					<td>
					<a title="Add/Edit Product" href="{{url('/admin/add-edit-cms-page/'.$cms['id'])}}"><i class="fa fa-pencil-square fa-lg" aria-hidden="true" style="color:green"></i></a> &nbsp;
					<a title="Delete" href="{{url('/admin/delete-cms-page/'.$cms['id'])}}"><i class="fa fa-trash-o fa-lg" aria-hidden="true" style="color:red"></i></a>
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