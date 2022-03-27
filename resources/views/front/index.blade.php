<?php use App\Product; ?>	
@extends('layouts.front_layout.front')
@section('content')
<div class="span9">
	<div class="well well-small">
		<h4>Featured Products <small class="pull-right">{{$productsCount}} featured products</small></h4>
		<div class="row-fluid">
			<div id="featured" @if($productsCount>4)class="carousel slide" @endif>
				<div class="carousel-inner">
				@foreach($featureProduct as $key=>$feature)
				
					<div class="item @if($key ==1)active @endif">
						<ul class="thumbnails">
							@foreach($feature as $key=>$items)
							<li class="span3">
								<div class="thumbnail">
									@if($key ==2)
									<i class="tag"></i>
									@endif
									<?php $image_path = "admin_images/product_images/small/".$items->main_image;?>
									@if(!empty($items->main_image) && file_exists($image_path))
										<a href="{{'product/'.$items->product_code.'/'.$items->id}}"><img src="{{asset('admin_images/product_images/small/'.$items->main_image )}}" alt=""></a>
										@else
										<a href="{{'product/'.$items->product_code.'/'.$items->id}}"><img src="{{asset('admin_images/product_images/small/on-image.png')}}" alt=""></a>
									@endif
									<div class="caption">
									<?php $discounted_price = Product::getDiscountPrice($items->id);?>
										<h5>{{$items->product_name}}</h5>
										<h4><a class="btn" href="product_details.html">VIEW</a>
											@if($items->product_discount >0)
											<span class="pull-right"><del style="color:red;">{{ $items->product_price }}</del> &nbsp;&nbsp;{{ $discounted_price }}</span>
											@else
											<span class="pull-right">{{ $items->product_price }}</span>
											@endif
										</h4>
									</div>
								</div>
							</li>
							@endforeach
						</ul>
					</div>
					@endforeach
				</div>
				<a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
				<a class="right carousel-control" href="#featured" data-slide="next">›</a>
			</div>
		</div>
	</div>
	
	<h4>Latest Products </h4>
	<ul class="thumbnails">
	@foreach($latestProduct as $product)
		<li class="span3">
			<div class="thumbnail">
				<?php $image_path = "admin_images/product_images/small/".$product->main_image;?>
				@if(!empty($items->main_image) && file_exists($image_path))
					<a href="{{'product/'.$product->product_code.'/'.$product->id}}"><img style="width:210px; height:180px;" src="{{asset('admin_images/product_images/small/'.$product->main_image )}}" alt=""></a>
					@else
					<a href="{{$product->product_code}}"><img src="{{asset('admin_images/product_images/small/on-image.png')}}" alt=""></a>
				@endif
				<div class="caption">
					<h5>{{$product->product_name}}</h5>
					<p>{{$product->product_code}} &nbsp; {{$product->product_color}}</p>
					
					<h4 style="text-align:center">
						<?php $discounted_price = Product::getDiscountPrice($product->id);?>
						<!-- <a class="btn" href="product_details.html"><i class="icon-zoom-in"></i></a> -->
						<a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> 
						@if($product->product_discount >0)
						<a class="btn btn-success" href="#"><del style="color:#e9e2f9;">{{$product->product_price}}</del> &nbsp;{{$discounted_price}}</a>
						@else
						<a class="btn btn-info" href="#">{{$product->product_price}}</a>
						@endif
					</h4>
				</div>
			</div>
		</li>
	@endforeach
	</ul>
</div>
@endsection