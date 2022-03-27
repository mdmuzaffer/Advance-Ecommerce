<?php use App\Product; ?>	
	<div class="tab-content">
		<div class="tab-pane" id="listView">
		@foreach($categoryProduct as $listpro)
			<div class="row">
				<div class="span2" >
					<img src="{{asset('admin_images/product_images/small/'.$listpro['main_image'])}}" alt=""/>
				</div>
				<div class="span4">
					<h3>{{$listpro['brand']['name']}}</</h3>
					<hr class="soft"/>
					<h5>{{$listpro['product_name']}}</h5>
					<p>{{$listpro['description']}}</p>
					<a class="btn btn-small pull-right" href="product_details.html">View Details</a>
					<br class="clr"/>
				</div>
				
				<div class="span3 alignR">
					<form class="form-horizontal qtyFrm">
						<?php $discounted_price = Product::getDiscountPrice($listpro['id']);?>
						
						@if($listpro['product_discount']>=0)
							@if(isset($discounted_price) && !empty($discounted_price))
								<del><h3>{{$listpro['product_price']}}</h3></del>
								<h4 style="text-align:centre; color:red;"><p>Discounted Price: {{ $discounted_price }}</p></h4>
							@else
							<h3>{{$listpro['product_price']}}</h3>
							@endif
						@endif
						
						<label class="checkbox">
							<input type="checkbox">  Adds product to compare
						</label><br/>
						
						<a href="product_details.html" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
						<a href="product_details.html" class="btn btn-large"><i class="icon-zoom-in"></i></a>
						
					</form>
				</div>
			</div>
			<hr class="soft"/>
			@endforeach
		</div>
		<div class="tab-pane  active" id="blockView">
			<ul class="thumbnails">
				@foreach($categoryProduct as $product)
				<li class="span3">
					<div class="thumbnail">
						<a href="{{url('/product/'.$product['product_code'].'/'.$product['id'])}}"><img style="height:220px" src="{{asset('admin_images/product_images/small/'.$product['main_image'])}}" alt=""/></a>
						<div class="caption">
							<h5>{{$product['product_name']}}</h5>
							<p>{{$product['brand']['name']}}</p>
							<h4 style="text-align:center"><a class="btn" href="product_details.html"><i class="icon-zoom-in"></i></a> 
								<a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a>
								@if($product['product_discount']>0)
								<a class="btn btn-primary" href="#"><del><span>{{$product['product_price']}}</span></del></a>
								@else
								<a class="btn btn-primary" href="#">{{$product['product_price']}}</a>
								@endif
							</h4>
							<?php $discounted_price = Product::getDiscountPrice($product['id']);?>
						</div>
						@if($product['product_discount']>=0)
							@if(isset($discounted_price) && !empty($discounted_price))
								<h4 style="text-align:centre; color:red;"><p>Discounted Price: {{ $discounted_price }}</p></h4>
							@else
							<div class="height:300px;"><br><br></div>
							@endif
						@endif
					</div>
				</li>
				@endforeach
			</ul>
			<hr class="soft"/>
		</div>
	</div>