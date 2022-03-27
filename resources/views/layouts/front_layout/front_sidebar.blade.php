<?php
use App\Section;
$getSections = Section::sections();
//echo"<pre>";print_r($getSections);echo"</pre>";

?>

<div id="sidebar" class="span3">
	<div class="well well-small">
		<a id="myCart" href="{{url('/cart')}}">
			<img src="{{asset('frontend/themes/images/ico-cart.png')}}" alt="cart">
				<span class="currentCartItems">{{ totalCartItems() }}</span> Items in your cart
		</a>
	</div>
	<ul id="sideManu" class="nav nav-tabs nav-stacked">
		@foreach($getSections as $section)
			<li class="subMenu"><a>{{$section->name}}</a>

			@if(!empty($section->categories))
			  <ul>
				@foreach($section->categories as $category)
				<li><a href="{{url('/'.$category->url)}}"><i class="icon-chevron-right"></i><strong>{{$category->category_name }}( {{CatProductCount($category->id)}})</strong></a></li>
					@foreach($category->subcategories as $subcategory)
					<li><a href="{{url('/'.$subcategory->url)}}"><i class="icon-chevron-right"></i>{{$subcategory->category_name }} ( {{CatProductCount($category->id)}})</a></li>
					@endforeach
				@endforeach
			  </ul>
			@endif
			</li>
		@endforeach
	
		@if(isset($page_list) && $page_list ="product_list" && !isset($_REQUEST['search_products']))
		<br>
		<li class="subMenu">
			<div class="well well-small">
				<h5>Fabric</h5>
				<ul>
					@foreach($fabricArray as $fabric)
					<li><p><input class="fabric" type="checkbox" name="fabricArray[]" value="{{$fabric}}"> <strong class="filter-text">{{$fabric}}</strong></p></li>
					@endforeach
				</ul>
			</div>
		</li>
		<li class="subMenu">
			<div class="well well-small">
				<h5>Sleeve</h5>
				<ul>
					@foreach($sleeveArray as $sleeve)
					<li><p><input class="sleeve" type="checkbox" name="sleeve[]" value="{{$sleeve}}"> <strong class="filter-text">{{$sleeve}}</strong></p></li>
					@endforeach
				</ul>
			</div>
		</li>
		<li class="subMenu">
			<div class="well well-small">
				<h5>Pattern</h5>
				<ul>
					@foreach($patternArray as $pattern)
					<li><p><input class="pattern" type="checkbox" name="pattern[]" value="{{$pattern}}"> <strong class="filter-text">{{$pattern}}</strong></p></li>
					@endforeach
				</ul>
			</div>
		</li>
		<li class="subMenu">
			<div class="well well-small">
				<h5>Fit</h5>
				<ul>
					@foreach($fitArray as $fit)
					<li><p><input class="fit" type="checkbox" name="fit[]" value="{{$fit}}"> <strong class="filter-text">{{$fit}}</strong></p></li>
					@endforeach
				</ul>
			</div>
		</li>
		<li class="subMenu">
			<div class="well well-small">
			<h5>Occasion</h5>
				<ul>
					@foreach($occasionArray as $occasion)
					<li><p><input class="occasion" type="checkbox" name="occasion[]" value="{{$occasion}}"> <strong class="filter-text">{{$occasion}}</strong></p></li>
					@endforeach
				</ul>
			</div>
		</li>
		
	@endif
	</ul>
	<div class="thumbnail">
		<img src="{{asset('frontend/themes/images/payment_methods.png')}}" title="Payment Methods" alt="Payments Methods">
		<div class="caption">
			<h5>Payment Methods</h5>
		</div>
	</div>
</div>