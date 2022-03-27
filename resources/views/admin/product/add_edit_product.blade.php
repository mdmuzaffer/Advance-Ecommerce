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
			}else{
			$url ="";
			}
			
			?>
            <form method="post" action="{{url('admin/product/add-edit-product/'.$url)}}" enctype="multipart/form-data">
				@csrf
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Product</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="productName">Product Name</label>
                                    <input  type="text" class="form-control" name="product_name" id="productName" placeholder="Product Name" 
									@if(!empty($productData['product_name'])) value="{{$productData['product_name']}}" @else value="{{old('product_name')}}" @endif>
                                </div>
								<div class="form-group" id="addCategory">
									<label>Select category level</label>
							
									<select required="" class="form-control select2 select2-hidden-accessible" id="category_id" name="category_id" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
										<option selected="selected" data-select2-id="3">Chose category</option>
									
										@foreach($categories as $section)
											<optgroup data-select2-id="30"  label="{{$section->name}}">
											@foreach($section->categories as $category)
												<option @if(!empty($productData['category_id'])&& $productData['category_id'] ==$category->id) selected="" @endif value="{{$category->id}}">-{{$category->category_name}}</option>
												@foreach($category->subcategories as $subcategory)
													<option @if(!empty($productData['category_id'])&& $productData['category_id'] ==$subcategory->id) selected="" @endif value="{{$subcategory->id}}"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--{{$subcategory->category_name}}</option>
												@endforeach
											@endforeach
											</optgroup>
											
										@endforeach
							
									</select>
								</div>   
						
                                <div class="form-group">
                                    <label for="product_code">Product code</label>
                                    <input type="text" required="" class="form-control" name="product_code" id="product_code" placeholder="Product code" 
									@if(!empty($productData['product_code'])) value="{{$productData['product_code']}}" @else value="{{old('product_code')}}" @endif>
                                </div>
								
								<div class="form-group">
                                    <label for="product_color">Product color</label>
                                    <input type="text" required="" class="form-control" name="product_color" id="product_color" placeholder="Product color"
									@if(!empty($productData['product_color'])) value="{{$productData['product_color']}}" @else value="{{old('product_color')}}" @endif>
                                </div>
								
								 <div class="form-group">
                                    <label for="product_price">Product price</label>
                                    <input type="number" required="" class="form-control" name="product_price" id="product_price" placeholder="Product price"
									@if(!empty($productData['product_price'])) value="{{$productData['product_price']}}" @else value="{{old('product_price')}}" @endif>
                                </div>
								
								 <div class="form-group">
                                    <label for="product_discount">Product Discount</label>
                                    <input type="text" required="" class="form-control" name="product_discount" id="product_discount" placeholder="Product Discount"
									@if(!empty($productData['product_discount'])) value="{{$productData['product_discount']}}" @else value="{{old('product_discount')}}" @endif>
                                </div>
								
								 <div class="form-group">
                                    <label for="product_gst">Product GST %</label>
                                    <input type="text"  class="form-control" name="product_gst" id="product_gst" placeholder="Product GST"
									@if(!empty($productData['product_gst'])) value="{{$productData['product_gst']}}" @else value="{{old('product_gst')}}" @endif>
                                </div>
								
								 <div class="form-group">
                                    <label for="product_weight">Product weight</label>
                                    <input type="text" required="" class="form-control" name="product_weight" id="product_weight" placeholder="Product weight"
									@if(!empty($productData['product_weight'])) value="{{$productData['product_weight']}}" @else value="{{old('product_weight')}}" @endif>
                                </div>
								
								<div class="custom-file"
								<label for="product_weight">Product video</label>
                            	<input type="file" class="custom-file-input" name="productvideo" id="productvideo">
                                <label class="custom-file-label" for="productvideo">video upload</label>
								</div>
								
								<div>
									<div>	
										@if(!empty($productData['product_video']))
											<a style="width:55px; height:50px; margin-top:5px;" href="{{asset('admin_images/product_videos/'.$productData['product_video'])}}" download>Download</a> ||
											<button class="btn btn-link"><a href="{{url('admin/product-video-delete/'.$productData['product_video'].'/'.$productData['id'])}}">Delete video</a></button>
										@endif
									</div>
								
								</div>
								
								
								<div class="form-group">
                                    <label for="group_code">Group Code</label>
                                    <input type="text" required="" class="form-control" name="group_code" id="group_code" placeholder="Group Code"
									@if(!empty($productData['group_code'])) value="{{$productData['group_code']}}" @else value="{{old('group_code')}}" @endif>
                                </div>
								
                                <div class="form-group">
                                    <label for="description">Product description</label>
                                    <textarea required="" class="form-control" rows="2" name="description" id="description" placeholder="Product description ..." >@if(!empty($productData['description'])) {{$productData['description']}} @else{{old('description')}}@endif</textarea>
                                </div>
								 <div class="form-group">
                                    <label for="wash_care">Product wash care</label>
                                    <input type="text" required="" class="form-control" name="wash_care" id="wash_care" placeholder="product wash care"
									@if(!empty($productData['wash_care'])) value="{{$productData['wash_care']}}" @else value="{{old('wash_care')}}" @endif>
                                </div>
								
								<div class="form-check">
									<input type="checkbox" class="form-check-input" id="exampleCheck1" name="featured" @if(!empty($productData['is_featured'])&& $productData['is_featured'] == "Yes") checked="" @endif value="Yes">
									<label class="form-check-label" for="exampleCheck1">Featured</label>
								 </div>
								
								<div class="form-check custom-Status">
								  <input type="checkbox" class="form-check-input" id="exampleCheck12" name="status" @if(!empty($productData['status'])&& $productData['status'] ==1) checked="" @endif value="1">
								  <label class="form-check-label" for="exampleCheck1">Status</label>
								</div>
                               
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        </div>
                        <!-- /.card -->
                    </div>

                    <div class="col-md-6">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Filter & SEO</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
									
										<div class="form-group">
                                            <label for="sleeve">Brands</label>
                                            <select required="" class="form-control select2 select2-hidden-accessible" name="brand" id="brand" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                <option disabled data-select2-id="30">Brand</option>
												
                                                @foreach($dataBrands as $brand)
													<option data-select2-id="30" @if(!empty($productData['brand_id']) && $productData['brand_id'] == $brand->id) selected="" @endif value="{{$brand->id}}">{{$brand->name}}</option>
                                                @endforeach
                                            </select>
										</div>
								
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label for="productImage">Product main Image</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="productImage" id="productImage">
                                                    <label class="custom-file-label" for="productImage">Choose file</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="">Upload</span>
                                                </div>
                                            </div>
											<div>	
												@if(!empty($productData['main_image']))
													
													<img style="width:55px; height:50px; margin-top:5px;" src="{{asset('admin_images/product_images/small/'.$productData['main_image'])}}">
													<button class="btn btn-warning"><a href="{{url('admin/product-image-delete/'.$productData['main_image'].'/'.$productData['id'])}}">Delete Image</a></button>
													@else
														
													<img style="width:55px; height:50px; margin-top:5px;" src="{{asset('admin_images/category_images/123456.jpg')}}">
												@endif
											</div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <!-- textarea -->
                                        <div class="form-group">
                                            <label for="fabric">Fabric</label>
                                            <select required="" class="form-control select2 select2-hidden-accessible" name="fabric" id="fabric" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                <option data-select2-id="30">Fabric</option>
                                                @foreach($fabricArray as $fabric)
													<option data-select2-id="30" @if(!empty($productData['fabric'])&& $productData['fabric'] == $fabric) selected="" @endif value="{{$fabric}}" myfabricVal="{{$fabric}}">{{$fabric}}</option>
                                                @endforeach
                                            </select>
                                        </div>
										
										 <div class="form-group">
                                            <label for="Pattern">Pattern</label>
											<select required="" class="form-control select2 select2-hidden-accessible" name="pattern" id="pattern" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                <option data-select2-id="30">Pattern</option>
                                                @foreach($patternArray as $pattern)
													<option data-select2-id="30" @if(!empty($productData['pattern'])&& $productData['pattern'] == $pattern) selected="" @endif value="{{$pattern}}" mypatternVal="{{$pattern}}">{{$pattern}}</option>
                                                @endforeach
                                            </select>
											
                                        </div>
										 <div class="form-group">
                                            <label for="sleeve">Sleeve</label>
                                            <select required="" class="form-control select2 select2-hidden-accessible" name="sleeve" id="sleeve" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                <option data-select2-id="30">Sleeve</option>
                                                @foreach($sleeveArray as $sleeve)
													<option data-select2-id="30" @if(!empty($productData['sleeve'])&& $productData['sleeve'] == $sleeve) selected="" @endif value="{{$sleeve}}" mysleeveVal="{{$sleeve}}">{{$sleeve}}</option>
                                                @endforeach
                                            </select>
										</div>
										 <div class="form-group">
                                            <label for="fit">Product fit</label>
											<select required="" class="form-control select2 select2-hidden-accessible" name="fit" id="fit" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                <option data-select2-id="30">Fit</option>
                                                @foreach($fitArray as $fit)
													<option data-select2-id="30" @if(!empty($productData['fit'])&& $productData['fit'] == $fit) selected="" @endif value="{{$fit}}" myfitVal="{{$fit}}">{{$fit}}</option>
                                                @endforeach
                                            </select>
										
										</div>
										 <div class="form-group">
                                            <label for="occasion">Product occasion</label>
											<select required="" class="form-control select2 select2-hidden-accessible" name="occasion" id="occasion" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                <option data-select2-id="30">Occasion</option>
                                                @foreach($occasionArray as $occasion)
													<option data-select2-id="30" @if(!empty($productData['occasion'])&& $productData['occasion'] == $occasion) selected="" @endif value="{{$occasion}}" myoccasionVal="{{$occasion}}">{{$occasion}}</option>
                                                @endforeach
                                            </select>
										</div>

                                        <div class="form-group">
                                            <label for="metaTitle">Meta title</label>
                                            <textarea required="" class="form-control" rows="2" name="meta_title" id="meta_title" placeholder="Meta Title">@if(!empty($productData['meta_title'])) {{$productData['meta_title']}} @else{{old('meta_title')}}@endif</textarea>
                                        </div>
										<div class="form-group">
											<label>Meta description</label>
											<textarea required="" class="form-control" name="meta_description" id="meta_description" rows="2" placeholder="Meta description ...">@if(!empty($productData['meta_description'])) {{$productData['meta_description']}} @else{{old('meta_description')}}@endif</textarea>
										</div>
										
                                        <div class="form-group">
                                            <label for="Meta keywords">Meta Keywords</label>
                                            <textarea required="" class="form-control" rows="2" name="meta_keywords" id="meta_keywords" placeholder="Meta keywords">@if(!empty($productData['meta_keywords'])) {{$productData['meta_keywords']}} @else{{old('meta_keywords')}}@endif</textarea>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection