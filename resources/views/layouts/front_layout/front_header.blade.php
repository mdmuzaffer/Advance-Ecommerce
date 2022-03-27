<?php
use App\Section;
$getSections = Section::sections();
//echo"<pre>";print_r($getSections);echo"</pre>";

?>
<div id="header">
	<div class="container">
		<div id="welcomeLine" class="row">
			<div class="span6">Welcome!<strong> {{ _('User')}}</strong></div>
			<div class="span6">
				<div class="pull-right">
				
				 <div class="navbar-search pull-left">
		            <input type="text" class="search-query" id="newsletter" name="newsletter" placeholder="Subscribe" value=""/>
					<button class="btn btn-info" id="newsletter_subscribe">Subscribe</button>
		          </div>
				&nbsp;
					<a href="{{url('/cart')}}">
						<span class="btn btn-mini btn-primary" style="margin-top: 12px">
							<i class="icon-shopping-cart icon-white"></i> [ <span class="currentCartItems">{{ totalCartItems() }}</span> ] Items in your cart 
						</span>
					</a>
				</div>
			</div>
		</div>
		<!-- Navbar ================================================== -->
		<section id="navbar">
		  <div class="navbar">
		    <div class="navbar-inner">
		      <div class="container">
		        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		          <span class="icon-bar"></span>
		          <span class="icon-bar"></span>
		          <span class="icon-bar"></span>
		        </a>
		        <a class="brand" href="{{url('/')}}">Muzaffer</a>
		        <div class="nav-collapse">
		          <ul class="nav">
		            <li class="active"><a href="{{url('/')}}">Home</a></li>
					<?php 
					/* echo"<pre>";
					print_r($getSections);
					die; */
					?>
					
					@foreach($getSections as $section)
		            <li class="dropdown">
		              <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{$section->name}} <b class="caret"></b></a>
		            @if(!empty($section->categories))
					  <ul class="dropdown-menu">
						@foreach($section->categories as $category)
		              	<li class="divider"></li>
							
							<li class="nav-header"><a href="{{url('/'.$category->url)}}">{{$category->category_name}}</a></li>
								@foreach($category->subcategories as $subcategory)
								<li><a href="{{url('/'.$subcategory->url)}}">{{$subcategory->category_name}}</a></li>
								@endforeach
								
						@endforeach
		              </ul>
					@endif
		            </li>
					@endforeach
								
		            <li><a href="{{url('about-us')}}">About</a></li>
		          </ul>
		          <form class="navbar-search pull-left" action="{{url('/search-products')}}" method="get">
		            <input type="text" class="search-query span2" name="search_products" placeholder="Search"/>
					<button type="submit">Go</button>
		          </form>
		          <ul class="nav pull-right">
					@if(Auth::check())
					<li><a href="{{url('/my-wishlist')}}">Wishlist</a></li>
					<li><a href="{{url('/my-orders')}}">My Orders</a></li>
		            <li class="divider-vertical"></li>
		            <li><a href="{{url('my-account')}}">Account</a></li>
		            <li><a href="{{url('logout')}}">Logout</a></li>
					@else
					<li><a href="{{url('/page/contact-us')}}">Contact</a></li>
		            <li class="divider-vertical"></li>
					<li><a href="{{url('login-register')}}">Login / Register</a></li>
					@endif
		          </ul>
		        </div><!-- /.nav-collapse -->
		      </div>
		    </div><!-- /navbar-inner -->
		  </div><!-- /navbar -->
		</section>
	</div>
</div>