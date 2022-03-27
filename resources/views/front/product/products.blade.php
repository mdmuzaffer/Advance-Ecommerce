@extends('layouts.front_layout.front')
@section('content')

<div class="span9">
	<ul class="breadcrumb">
		<li><a href="{{url('/')}}">Home</a><span class="divider">/</span></li>
		<li><a href="{{url('/'.$catDetails['categoryDetails']['url'])}}">{{$catDetails['categoryDetails']['category_name']}}</a></li>
	</ul>
	<h3>{{$catDetails['categoryDetails']['category_name']}}<small class="pull-right"><?php echo count($categoryProduct);?> products are available </small></h3>
	<hr class="soft"/>
	<p>{{$catDetails['categoryDetails']['description']}}</p>
	@if(!isset($_REQUEST['search_products']))
	<hr class="soft"/>
	<form class="form-horizontal span6" name="sortProducts" id="sortProducts">
		<input type="hidden" name="url" id="url" value="{{$url}}">
		<div class="control-group">
			<label class="control-label alignL">Sort By </label>
			<select name="sort" id="sort">
				<option value="">Select</option>
				<option value="latest_product" @if(isset($_GET['sort']) && $_GET['sort'] =='latest_product') selected="" @endif>Latest Products</option>
				<option value="product_name_az" @if(isset($_GET['sort']) && $_GET['sort'] =='product_name_az') selected="" @endif>Product name A - Z</option>
				<option value="product_name_za" @if(isset($_GET['sort']) && $_GET['sort'] =='product_name_za') selected="" @endif>Product name Z - A</option>
				<option value="lowest_price" @if(isset($_GET['sort']) && $_GET['sort'] =='lowest_price') selected="" @endif>Lowest Price</option>
				<option value="height_price" @if(isset($_GET['sort']) && $_GET['sort'] =='height_price') selected="" @endif>Height Price</option>
			</select>
		</div>
	</form>
	
	@endif
	<div id="myTab" class="pull-right">
		<a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
		<a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
	</div>
	<br class="clr"/>
	<div class="tab-content filter_products">
		@include('front.product.ajax_product_list')
	</div>
	
	<a href="compair.html" class="btn btn-large pull-right">Compair Product</a>
	@if(!isset($_REQUEST['search_products']))
		<div class="pagination">
		@if(isset($_GET['sort']) && !empty($_GET['sort']))
		{{ $categoryProduct->appends(['sort' => $_GET['sort']])->links() }}
		@else
		{{ $categoryProduct->links() }}
		@endif
		</div>
	@endif
	<br class="clr"/>
</div>

@endsection