@extends('layouts.admin_layout.admin_design')
@section('content')
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product Tables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product Tables</li>
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
              <h3 class="card-title">Product Table</h3>
				@if ($message = Session::get('success'))
					<br>
					<div class="alert alert-success alert-block">
						<button type="button" class="close" data-dismiss="alert">×</button>	
						<strong>{{ $message }}</strong>
					</div>
				@endif
				  <button class="btn btn-info float-right"><span>
				  <a href="{{url('admin/product/add-edit-product')}}" style="color:#fff;">Add Product</a>
				  </span></button>
			  
			  
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Product Name</th>
                  <th>Product Code</th>
                  <th>Product Color</th>
                  <th>Product Image</th>
                  <th>Category</th>
                  <th>Section</th>
                  <th>Status</th>
                  <th>&nbsp;&nbsp;&nbsp;&nbsp; Actions &nbsp;&nbsp;&nbsp;&nbsp;</th>
                </tr>
                </thead>
                <tbody>
				
				@foreach($productsData as $product)
                <tr>
					<td>{{$product->id}}</td>
					<td>{{$product->product_name}}</td>
					<td>{{$product->product_code}}</td>
					<td>{{$product->product_color}}</td>
					<td>
					<?php $image_path = "admin_images/product_images/small/".$product->main_image; ?>
					@if(!empty($product->main_image) && file_exists($image_path))
					<img src="{{asset('/admin_images/product_images/small/'.$product->main_image)}}" alt="image" width="80px" height="100px">
					@else
					<img src="{{asset('/admin_images/product_images/small/no-image.png')}}" alt="image" width="80px" height="100px">
					@endif
					</td>
					<td>{{$product->category->category_name}}</td>
					<td>{{$product->section->name}}</td>
					
					@if(isset($productAccess) && $productAccess[0]['full_access'] =='1')
						<td>
						@if(isset($productAccess) && $productAccess[0]['view_access'] =='1')
							@if($product->status ==1)
								<a href="javascript:void(0)" class="productUpdateStatus" id="product-{{$product->id}}" status-id="{{$product->id}}" status="{{$product->status}}">Active</a>
							@else
								<a style="color:red;" href="javascript:void(0)" class="productUpdateStatus" id="product-{{$product->id}}" status-id="{{$product->id}}" status="{{$product->status}}">Inactive</a>
							@endif
						@endif
						</td>
						<td>
						@if(isset($productAccess) && $productAccess[0]['edit_access'] =='1')
							<a title="Add/Edit Attribute" href="{{url('admin/product/add-attributes/'.$product->id)}}"><i class="fa fa-plus fa-lg" aria-hidden="true" style="color:blue"></i></a>&nbsp;&nbsp;
							<a title="Add/Edit Product" href="{{url('admin/product/add-edit-product/'.$product->id)}}"><i class="fa fa-pencil-square fa-lg" aria-hidden="true" style="color:green"></i></a>&nbsp;&nbsp;
							<a title="Delete" href="{{url('admin/product/delete/'.$product->id)}}"><i class="fa fa-trash-o fa-lg" aria-hidden="true" style="color:red"></i></a>&nbsp;&nbsp;
							<a title="Product/Images" href="{{url('admin/product/add-images/'.$product->id)}}"><i class="far fa-image"style="color:lime" ></i></a>
							<!--<a href="{{url('admin/product/add-edit-product/'.$product->id)}}">Edit</a> || <a href="{{url('admin/product/delete/'.$product->id)}}">Delete</a> -->
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