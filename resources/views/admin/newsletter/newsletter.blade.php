@extends('layouts.admin_layout.admin_design')
@section('content')
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Rating</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Rating</li>
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
              <h3 class="card-title">Subscriber</h3>
              <button class="btn btn-info float-right"><a style="color:#fff;" href="{{url('admin/export-newsletter-subscribers/')}}">Export Subscribers</a></button>
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
                  <th>User Email</th>
				  <th>Created</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
				@foreach($newsData as $news)
                <tr>
					<td>{{ $news['id'] }}</td>
				
					<td>{{ $news['email'] }}</td>
					
					<td>{{ DateFormate($news['created_at'])}}</td>
					
					<td>@if($news['status'] ==1) 
						<a href="javascript:void(0)" class="newsUpdateStatus" id="news-{{$news['id']}}" status-id="{{$news['id']}}" status="{{$news['status']}}">Active</a>
						@else
						<a href="javascript:void(0)" style="color:red;" class="newsUpdateStatus" id="news-{{$news['id']}}" status-id="{{$news['id']}}" status="{{$news['status']}}">Inactive</a>
						@endif
					</td>
					<td>
					<a title="Delete" href="{{url('/admin/delete-news/'.$news['id'])}}"><i class="fa fa-trash-o fa-lg" aria-hidden="true" style="color:red"></i></a>
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