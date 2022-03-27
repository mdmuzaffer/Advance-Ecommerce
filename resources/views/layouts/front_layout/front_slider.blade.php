<?php
use App\Banner;
$bannerData = Banner::getBanner();
?>
<div id="carouselBlk">
	<div id="myCarousel" class="carousel slide">
		<div class="carousel-inner">
			@foreach($bannerData as $key=>$banner)
			<div class="item @if($key ==0) active @endif">
				<div class="container">
					<a href="@if(!empty($banner['links'])){{$banner['links']}} @endif">
						<img style="width:100%" src="{{asset('admin_images/banner_images/'.$banner['image'])}}" title="{{$banner['alt']}}" />
						<h1>{{$banner['title']}}</h1>
					</a>
					<div class="carousel-caption">
						<h4>{{$banner['alt']}}</h4>
					</div>
				</div>
			</div>
			@endforeach
		</div>
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
	</div>
</div>