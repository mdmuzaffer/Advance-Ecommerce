@extends('layouts.admin_layout.admin_design') @section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Images Tables</h1> </div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Product Images</li>
					</ol>
				</div>
			</div>
		</div>
		
		@if ($message = Session::get('success'))
			<br>
			<div class="alert alert-success alert-block">
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
		
		
		<!-- /.container-fluid -->
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-12">
				<div class="card">
			
					<!-- Main content -->
					<section class="content">
						<div class="container-fluid">
							<?php 
							if(!empty($productImages->id)){
							$url = $productImages->id;
							}?>
								<form method="post" action="{{url('admin/product/add-images/'.$url)}}" enctype="multipart/form-data">
								@csrf
									<div class="row">
										<!-- left column -->
										<div class="col-md-8">
											<!-- general form elements -->
											<div class="card card-primary">
												<div class="card-header">
													<h3 class="card-title">Product Attributes</h3> </div>
												<!-- form start -->
												<div class="card-body">
													<div class="form-group">
														<label for="productName">Product Name: {{$productImages->product_name}}</label>
													</div>
													<div class="form-group">
														<label for="product_code">Product code: {{$productImages->product_code}}</label>
													</div>
													<div class="form-group">
														<label for="product_color">Product color: {{$productImages->product_color}}</label>
													</div>
													
													<div class="custom-file">
														<input required="" type="file" name="productsImage[]" id="productsImage" multiple>
														<label class="custom-file-label" for="productsImage">Choose images</label>
													</div>
													
													<div class="card-footer">
														<button type="submit" class="btn btn-primary">Add Images</button>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<!-- general form elements -->
											<div class="card card-primary">
												<div> 
												@if(!empty($productImages->main_image))
													<img style="width:100px; height:160px; margin-top:45px; margin-left:20px; padding-bottom:22px;" src="{{asset('admin_images/product_images/small/'.$productImages->main_image)}}">
													@else 
													<img style="width:100px; height:160px; margin-top:45px; margin-left:20px; padding-bottom:22px;" src="{{asset('admin_images/category_images/123456.jpg')}}">
												@endif 
												</div>
											</div>
										</div>
									</div>
								</form>
								<!-- /.content -->
						</div>
					</section>
					<!-- /.card-header -->
					<div class="card-body">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>ID</th>
									<th>Product ID</th>
									<th>Product Image</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody> 
							@foreach($productImages->images as $image)
								<tr>
									<td>{{$image->id}}</td>
									<td>{{$image->product_id}}</td>
									<td>
									@if(!empty($image->image))
										<img style="width:100px; height:80px;" src="{{asset('admin_images/images_product/small/'.$image->image)}}">
									@else
										<img style="width:100px; height:80px; margin-top:25px;" src="{{asset('admin_images/category_images/123456.jpg')}}">
									@endif
									</td>
									<td>@if($image->status ==1)
										<a href="{{url('/admin/product/add-images/status/'.$image->id)}}" style="color:#007bff">Active</a>
										@else
										<a href="{{url('/admin/product/add-images/status/'.$image->id)}}" style="color:red">Inactive</a>
										@endif
										</td>
									<td><button class="btn btn-danger"><a href="{{url('/admin/product/add-images/delete/'.$image->id)}}">Delete</a></button></td>
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