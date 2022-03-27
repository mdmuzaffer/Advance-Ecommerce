@extends('layouts.admin_layout.admin_design') @section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1>Add Category</h1> -->
                    <h1>{{$title}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{{$title}}</li>
                    </ol>
                </div>
            </div>
			
			@if ($message = Session::get('success'))
				<br>
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button>	
					<strong>{{ $message }}</strong>
				</div>
			@endif
			
			@if (Session::has('error_message'))
				<br>
				<div class="alert alert-danger alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button>	
					<strong>{{ Session::get('error_message') }}</strong>
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
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
			<?php 
			if(!empty($productData['id'])){
			$url = $productData['id'];
			}?>
            <form method="post" action="{{url('admin/product/add-attributes/'.$url)}}" enctype="multipart/form-data">
				@csrf
                <div class="row">
                    <!-- left column -->
					<div class="col-md-8">
							<!-- general form elements -->
						<div class="card card-primary">
							<div class="card-header">
								<h3 class="card-title">Product Attributes</h3>
							</div>
								<!-- form start -->
							<div class="card-body">
								<div class="form-group">
									<label for="productName">Product Name: {{$productData['product_name']}}</label>
								</div>  
						
								<div class="form-group">
									<label for="product_code">Product code: {{$productData['product_code']}}</label>
								</div>
								
								 <div class="form-group">
									<label for="product_color">Product color: {{$productData['product_color']}}</label>
								</div>
								 <div class="form-group">
									<label for="product_price">Product price: {{$productData['product_price']}}</label>
								</div>
								<!-- /.card-body -->
								<div class="card-footer">
									<button type="submit" class="btn btn-primary">Add Attribute</button>
								</div>
								
								<div>
								
							<div class="well clearfix">
								<div id="czContainer">
									<div id="first">
										<div class="recordset">
											<div class="fieldRow clearfix">
												<div class="col-md-3">
													<div id="div_id_stock_1_sku" class="form-group">
														<label for="id_stock_1_sku" class="control-label  requiredField">
															SKU<span class="asteriskField">*</span>
														</label><div class="controls ">
																	<input type="text" name="stock_1_sku" id="id_stock_1_sku" class="textinput form-control" />
														</div>
													</div>
												</div>
												<div class="col-md-3">
													<div id="div_id_stock_1_unit" class="form-group">
														<label for="id_stock_1_size" class="control-label  requiredField">
															Size<span class="asteriskField">*</span>
														</label><div class="controls "><input type="text" class="form-control" id="id_stock_1_size" name="stock_1_size"></div>
													</div>
												</div>
												<div class="col-md-3">
													<div id="div_id_stock_1_price" class="form-group">
														<label for="id_stock_1_price" class="control-label  requiredField">
															Price<span class="asteriskField">*</span>
														</label><div class="controls "><input class="numberinput form-control" id="id_stock_1_price" name="stock_1_price" type="text"/> </div>
													</div>
												</div>
												<div class="col-md-2">
													<div id="div_id_stock_1_stock" class="form-group">
														<label for="id_stock_1_stock" class="control-label  requiredField">
															Stock<span class="asteriskField">*</span>
														</label><div class="controls "><input class="numberinput form-control" id="id_stock_1_stock" name="stock_1_stock" type="number" /> </div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
								
								</div>
								
							</div>
							<!-- /.card -->
						</div>
                    </div>
					<!-- text input -->
					<div>	
						@if($productData['main_image']!=='NULL')
							<img style="width:100px; height:100px; margin-top:45px;" src="{{asset('admin_images/product_images/small/'.$productData['main_image'])}}">
							<!-- <button class="btn btn-warning"><a href="{{url('admin/product-image-delete/'.$productData['main_image'].'/'.$productData['id'])}}">Delete Image</a></button> -->
							@else
							<img style="width:100px; height:100px; margin-top:45px;" src="{{asset('admin_images/category_images/123456.jpg')}}">
						@endif
					</div>
                </div>
            </form>
    <!-- /.content -->
		</div>
	</section>
 
	<section class="content">
      <div class="row"> 
 <!-- /.card-header -->	  
	<div class="col-12">
          <div class="card">
		  <form method="post" action="{{url('admin/product/update-attributes/')}}">
			@csrf
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>SKU</th>
                  <th>Size</th>
                  <th>Price</th>
                  <th>Stock</th>
                  <th>Status</th>
                  <th>Action</th>
                 
                </tr>
                </thead>
                <tbody>
				
				@foreach($productData['attribute'] as $attributes)
                <tr>
					<td>{{$attributes['id']}}</td>
					<input type="hidden" name="AttId[]" value="{{$attributes['id']}}" />
					<td><input type="text" name="sku[]" value="{{$attributes['sku']}}" /></td>
					<td><input type="text" name="size[]" value="{{$attributes['size']}}" /></td>
					<td><input type="text" name="price[]" value="{{$attributes['price']}}" /></td>
					<td><input type="text" name="stock[]" value="{{$attributes['stock']}}" /></td>
					<td>@if($attributes['status'] ==1)<a href="{{url('/admin/product/attribute-status/'.$attributes['id'])}}"><i class="fa fa-check" aria-hidden="true"></i></a>
					@else<a href="{{url('/admin/product/attribute-status/'.$attributes['id'])}}"><i class="fa fa-times" aria-hidden="true" style="color:red"></i></a>@endif</i></td>
					<td><a title="Delete" href="{{url('/admin/product/attribute-delete/'.$attributes['id'])}}"><i class="fa fa-trash-o fa-lg" aria-hidden="true" style="color:red"></i></a></td>
					
                </tr>
				@endforeach
                </tbody>
              </table>
			<div class="card-footer">
				<button type="submit" class="btn btn-primary">Update Attribute</button>
			</div>
            </div>
			</form>
		</div>
	</div>
	</div>
	</div>
			
        </div>
        <!-- /.row -->
    </section>

<!-- /.content-wrapper -->

@endsection