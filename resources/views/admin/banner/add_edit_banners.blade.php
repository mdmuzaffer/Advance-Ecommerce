@extends('layouts.admin_layout.admin_design')
@section('content')
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{$title}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{$title}}</li>
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
              <h3 class="card-title">{{$title}}</h3>
			  <div style="float:right; color:#fff"><button type="button" class="btn btn-success"><a style="color:#fff" href="{{url('/admin/banners/')}}">Banner List</a></button></div>
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
			
			
			<div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">{{$button}}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
			  
              <form class="form-horizontal" method="post" action="{{url('admin/banners/add-edit/'.$id)}}" enctype="multipart/form-data">
			  @csrf
                <div class="card-body">
                  <div class="form-group row">
				  
                   <label for="brand">Image</label>
					<div class="col-sm-5">
                      <input type="file" class="form-control" id="bannerImage" name="bannerImage">
                    </div>
					
					<label for="brand">Title</label>
					<div class="col-sm-6">
                      <input type="text" class="form-control" id="title" placeholder="title" name="bannerTitle" @if(!empty($banner['title'])) value="{{$banner['title']}}" @endif>
                    </div>
					<br>
					<br>
					<br>
					<label for="brand">Links &nbsp;</label>
					<div class="col-sm-5">
                      <input type="text" class="form-control" id="link" placeholder="Link" name="bannerLinks" @if(!empty($banner['links'])) value="{{$banner['links']}}" @endif>
                    </div>
					<label for="brand">Alts</label>
					<div class="col-sm-6">
                      <input type="text" class="form-control" id="alts" placeholder="alts" name="bannerAlts" @if(!empty($banner['alt'])) value="{{$banner['alt']}}" @endif>
                    </div>
					
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">{{$button}}</button>
                </div>
                <!-- /.card-footer -->
              </form>
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