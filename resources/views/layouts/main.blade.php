<?php
	use App\Models\ImagesSetting;
	use App\Models\Posts;
	use App\Models\BossData;
	/* Specific page contain sidebar or not */ 
	$sidebar = (bool)(isset($sidebar) ? $sidebar : true);
	/* Specific page breadcrumb */ 
	$breadcrumb = (isset($breadcrumb) ? $breadcrumb : null);
	if(!$breadcrumb) {
		$breadcrumb = [
			'name' => 'home',
			'object' => ''
		];
	}
	$logo = ImagesSetting::find(1);
	$top_ads = ImagesSetting::find(2);
	$sidebar_ads = ImagesSetting::find(3);
	$random_posts = Posts::getRandomPosts();
	$popular = Posts::getPopularPosts();
	$top_sidebar_posts = $random_posts;
	$is_post = false;
	if(isset($category) && isset($post) && $category->id) {
	    $is_post = true;
	    $top_sidebar_posts = Posts::getRandomPosts($category->id, $post->id);
	}
	/* Detect theme */
	$theme = session('theme', '');
?>

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="no-js">
	<head>
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="/images/favicon.ico">
		<!-- Author Meta -->
		<meta name="author" content="colorlib">
		<!-- Meta Description -->
		<meta name="description" content="">
		<!-- Meta Keyword -->
		<meta name="keywords" content="">
		<!-- CSRF -->
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- meta character set -->
		<meta charset="UTF-8">
		<!-- meta image -->
		<meta property="og:image" content="@yield('thumbnail', '/images/thumbnail.jpg')">
		<!-- Site Title -->
		<title>@yield('title') - BDO Việt Nam</title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<!--
		CSS
		============================================= -->
		<link rel="stylesheet" href="{{ asset('css/linearicons.css') }}">
		<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
		<link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
		<link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
		<link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
		<link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
		<link rel="stylesheet" href="{{ asset('css/main.css') }}">
		<link rel="stylesheet" href="{{ asset('css/classes.css') }}">
		<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
		<link rel="stylesheet" href="{{ asset('css/breadcrumb.css') }}">
		@if ($theme)
		<link rel="stylesheet" href="{{ asset('css/custom-background.css') }}">
		<style type="text/css">
			body {
			    background-image:    url('/images/background/{{ $theme }}.jpg');
			    background-size:     cover;
			    background-repeat:   no-repeat;
			    background-attachment: fixed;
			    background-position: center center;
			}
		</style>
		@endif

		@yield('css')
	</head>
	<body>
		<input type="hidden" value="{{ route('set_theme_api') }}" id="set_theme_api" />
		<header>
			@include('include.header')
		</header>
		
		<div class="site-main-container">
			@include('include.content-top')
			@if ($sidebar)
			<section class="latest-post-area pb-120">
			    <div class="container no-padding">
			        <div class="row">
			            <div class="col-lg-8 post-list">
			            	@yield('content')
			            </div>
			            <div class="col-lg-4">
			                @include('include.sidebar')
			            </div>
			        </div>
			    </div>
			</section>
			@else
			<section class="latest-post-area pb-120">
			    @yield('content')
			</section>
			@endif
		</div>
		
		@include('include.footer')
		<script src="{{ asset('js/vendor/jquery-2.2.4.min.js') }}"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
		<script src="{{ asset('js/easing.min.js') }}"></script>
		<script src="{{ asset('js/hoverIntent.js') }}"></script>
		<script src="{{ asset('js/superfish.min.js') }}"></script>
		<script src="{{ asset('js/jquery.ajaxchimp.min.js') }}"></script>
		<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
		<script src="{{ asset('js/mn-accordion.js') }}"></script>
		<script src="{{ asset('js/jquery-ui.js') }}"></script>
		<script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
		<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
		<script src="{{ asset('js/mail-script.js') }}"></script>
		<script src="{{ asset('js/main.js') }}"></script>
		<script src="{{ asset('js/timer.js') }}"></script>
		<script src="{{ asset('js/custom.js') }}"></script>
		<script type="text/javascript">
			var bosses_table = {!! BossData::find(1)->data !!};
		</script>
		<script src="{{ asset('js/bosses.js') }}"></script>
		@yield('js')
	</body>
</html>