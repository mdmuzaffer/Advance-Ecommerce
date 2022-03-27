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
			  <div style="float:right; color:#fff"><button type="button" class="btn btn-success"><a style="color:#fff" href="{{url('/admin/cms-pages')}}">Cms List</a></button></div>
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
                <h3 class="card-title">Cms Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" method="post" action="{{url('admin/add-edit-cms-page/'.$id)}}">
			  @csrf
                <div class="card-body">
				
                  <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">{{__('Title')}}</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="title" placeholder="page title" name="title" @if(!empty($Cmspage['title']))value="{{$Cmspage['title']}}" @endif>
                    </div>
					<label for="description" class="col-sm-2 col-form-label">{{__('Description')}}</label>
					<div class="col-sm-4">
                      <textarea class="form-control" id="page-description" placeholder="Description" name="description" > @if(!empty($Cmspage['description'])){{$Cmspage['description']}} @endif</textarea>
                    </div>
                  </div>
				  
				   <div class="form-group row">
                    <label for="url" class="col-sm-2 col-form-label">{{__('Url')}}</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="url" placeholder="url" name="url" @if(!empty($Cmspage['url']))value="{{$Cmspage['url']}}" @endif>
                    </div>
					<label for="meta_title" class="col-sm-2 col-form-label">{{__('Meta title')}}</label>
					<div class="col-sm-4">
                      <input type="text" class="form-control" id="meta_title" placeholder="Meta title" name="meta_title" @if(!empty($Cmspage['meta_title']))value="{{$Cmspage['meta_title']}}" @endif>
                    </div>
                  </div>
				  
				   <div class="form-group row">
                    <label for="meta_description" class="col-sm-2 col-form-label">{{__('Meta description')}}</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="meta_description" placeholder="meta_description" name="meta_description" @if(!empty($Cmspage['meta_description']))value="{{$Cmspage['meta_description']}}" @endif>
                    </div>
					<label for="meta_keywords" class="col-sm-2 col-form-label">{{__('Meta keywords')}}</label>
					<div class="col-sm-4">
                       <input type="text" class="form-control" id="meta_keywords" placeholder="Meta keywords" name="meta_keywords" @if(!empty($Cmspage['meta_keywords']))value="{{$Cmspage['meta_keywords']}}" @endif>
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