<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Stack Developers online Shopping cart</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<!-- <meta http-equiv="refresh" content="1" /> -->
	
	<!-- Front style -->
	<link id="callCss" rel="stylesheet" href="{{asset('frontend/themes/css/front.min.css')}}" media="screen"/>
	<link href="{{asset('frontend/themes/css/base.css')}}" rel="stylesheet" media="screen"/>
	<!-- Front style responsive -->
	<link href="{{asset('frontend/themes/css/front-responsive.min.css')}}" rel="stylesheet"/>
	<link href="{{asset('frontend/themes/css/font-awesome.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('frontend/validation/css/screen.css')}}" rel="stylesheet" type="text/css">
	<!-- Google-code-prettify -->
	<link href="{{asset('frontend/themes/js/google-code-prettify/prettify.css')}}" rel="stylesheet"/>
	<!-- fav and touch icons -->
	<link rel="shortcut icon" href="{{asset('frontend/themes/images/ico/favicon.ico')}}">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('frontend/themes/images/ico/apple-touch-icon-144-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('frontend/themes/images/ico/apple-touch-icon-114-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('frontend/themes/images/ico/apple-touch-icon-72-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" href="{{asset('frontend/themes/images/ico/apple-touch-icon-57-precomposed.png')}}">
	<style type="text/css" id="enject"></style>
<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=61421e96d602b900198af485&product=sticky-share-buttons' async='async'></script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/615dd56725797d7a8902a865/1fhb8j88p';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

</head>
<body>

<!-- Strart Header ================================================================== --->
@include('layouts.front_layout.front_header')
<!-- Header End====================================================================== -->

<!-- Slider start====================================================================== -->
@if(isset($page_type) && $page_type =='frontIndex')
	@include('layouts.front_layout.front_slider')
@endif
<!-- Slider start====================================================================== -->

<div id="mainBody">
	<div class="container">
		<div class="row">
			<!-- Sidebar ================================================== -->
		
			@include('layouts.front_layout.front_sidebar')
			<!-- Sidebar end=============================================== -->
			
			@yield('content');
			
		</div>
	</div>
</div>
<!-- Footer ================================================================== -->
@include('layouts.front_layout.front_footer')
<!-- Placed at the end of the document so the pages load faster ============================================= -->

<script src="{{asset('frontend/themes/js/jquery.js')}}" type="text/javascript"></script>
<script src="{{asset('frontend/validation/jquery.validate.js')}}" type="text/javascript"></script>
<script src="{{asset('frontend/themes/js/front.min.js')}}" type="text/javascript"></script>
<script src="{{asset('frontend/themes/js/google-code-prettify/prettify.js')}}"></script>

<script src="{{asset('frontend/themes/js/front.js')}}"></script>
<script src="{{asset('frontend/themes/js/jquery.lightbox-0.5.js')}}"></script>

@if(isset($page_type) && $page_type =="front_page")
<script src="{{asset('frontend/developer/developer.js')}}"></script>
@endif

</body>
</html>