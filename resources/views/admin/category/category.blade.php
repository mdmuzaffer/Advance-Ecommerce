@extends('layouts.admin_layout.admin_design')
@section('content')
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Category Tables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Category</li>
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
              <h3 class="card-title">Category</h3>
			  
			@if ($message = Session::get('success'))
				<br>
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button>	
					<strong>{{ $message }}</strong>
				</div>
			@endif
			  <button class="btn btn-info float-right"><span>
			  <a href="{{url('admin/add-edit-category/')}}" style="color:#fff;">Add Category</a>
			  </span></button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example_category" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Section</th>
                  <th>Parent Category</th>
                  <th>Category</th>
                  <th>Url</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
				@foreach($categoryData as $category)
				@if(!isset($category->parent_category->category_name))
					<?php $parent_category ="Root"; ?>
					@else
					<?php $parent_category = $category->parent_category->category_name; ?>
				@endif
                <tr>
					<td>{{$category->id}}</td>
					<td>{{$category->section->name}}</td>
					<td>{{$parent_category}}</td>
					<td>{{$category->category_name}}</td>
					<td>{{$category->url}}</td>
					
					@if(isset($categoryAccess) && $categoryAccess[0]['full_access'] =='1')
					<td>@if(isset($categoryAccess) && $categoryAccess[0]['view_access'] =='1')
						@if($category->status ==1) 
						<a href="{{url('/admin/category/status/'.$category->id)}}" class="categoryUpdateStatus" id="category-{{$category->id}}" status-id="{{$category->id}}" status="{{$category->status}}">Active</a>
						@else
						<a href="{{url('/admin/category/status/'.$category->id)}}" style="color:red;" class="categoryUpdateStatus" id="category-{{$category->id}}" status-id="{{$category->id}}" status="{{$category->status}}">Inactive</a>
						@endif
						@endif
					</td>
					<td>
					@if(isset($categoryAccess) && $categoryAccess[0]['edit_access'] =='1')
					<button class="btn btn-primary"><span>
					  <a href="{{url('admin/add-edit-category/'.$category->id)}}" style="color:#fff;">Edit</a>
					  </span></button>||<button class="btn btn-danger"><span>
					  <a href="{{url('admin/delete-category/'.$category->id)}}" style="color:#fff;">Delete</a>
					  </span>
					</button>
					@endif
					</td>
					@endif
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