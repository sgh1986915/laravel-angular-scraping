<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title> 
			@section('title') 
			{{trans('pages.name')}}
			@show 
		</title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- Bootstrap 3.0: Latest compiled and minified CSS -->

		<!-- <link rel="stylesheet" type="text/css" href="//bootswatch.com/yeti/bootstrap.min.css"> -->

		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

		<script type="text/javascript" src="http://www.google.com/jsapi"></script>

		<link rel="stylesheet" type="text/css" href="{{ asset('piluku-html/assets/css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ asset('piluku-html/assets/css/material.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('piluku-html/assets/css/style.css') }}">	
		<link rel="stylesheet" type="text/css" href="{{ asset('piluku-html/assets/css/signin2.css') }}">

		<link rel="stylesheet" type="text/css" href="{{ asset('css/mystyles.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/messenger.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/messenger-theme-future.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/popup.css') }}">

		<link rel="stylesheet" href="{{ asset('bower_components/angular-loading-bar/build/loading-bar.css') }}">
		<link rel="stylesheet" href="{{ asset('bower_components/angular-bootstrap-lightbox/dist/angular-bootstrap-lightbox.css') }}">

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- JS -->
		<!--
		<script src='assets/js/jquery-ui-1.10.3.custom.min.js'></script>
		<script src='assets/js/bootstrap.min.js'></script>
		-->
		

		<script src="{{ asset('js/jquery-2.0.2.min.js') }}"></script>
		<script src="{{ asset('js/bootstrap.min.js') }}"></script>

		<script src="{{ asset('piluku-html/assets/js/jquery.nicescroll.min.js') }}"></script>
		<script src="{{ asset('piluku-html/assets/js/wow.min.js') }}"></script>
		<script src="{{ asset('piluku-html/assets/js/jquery.loadmask.min.js') }}"></script>
		<script src="{{ asset('piluku-html/assets/js/jquery.accordion.js') }}"></script>
		<script src="{{ asset('piluku-html/assets/js/materialize.js') }}"></script>
		<script src="{{ asset('piluku-html/assets/js/bic_calendar.js') }}"></script>
		<script src="{{ asset('piluku-html/assets/js/core.js') }}"></script>
		<script src="{{ asset('piluku-html/assets/js/jquery.countTo.js') }}"></script>
		
		<script src="{{ asset('js/restfulizer.js') }}"></script> 
		<script src="{{ asset('bower_components/angular/angular.js') }}"></script>
		<!--<script src="//cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.20/angular.min.js"></script>-->
		<script src="{{ asset('js/ng-videosharing-embed.min.js') }}"></script>
		<script src="http://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.2.0.js"></script>
		<script src="{{ asset('js/messenger.min.js') }}"></script>
		<!-- // <script src="{{ asset('js/ui-bootstrap-custom-tpls-0.10.0.min.js') }}"></script> -->
		<script src="{{ asset('js/messenger-theme-future.js') }}"></script>
		<script src="{{ asset('js/popup.js') }}"></script>
		<script src="{{ asset('js/script.js') }}"></script>
		<script src="{{ asset('js/app.js') }}"></script>

		<script src="{{ asset('bower_components/angular-touch/angular-touch.js') }}"></script>
		<script src="{{ asset('bower_components/angular-bootstrap/ui-bootstrap-tpls.js') }}"></script>
		<script src="{{ asset('bower_components/angular-loading-bar/build/loading-bar.js') }}"></script>
		<script src="{{ asset('bower_components/angular-bootstrap-lightbox/dist/angular-bootstrap-lightbox.js') }}"></script>


		<script type='text/javascript'>
 			google.load("visualization", "1", {packages:["corechart"]});
   		</script>

		<style type="text/css">
			.dropdown:hover .dropdown-menu {
			    display: block;
			 }
		</style>
	</head>
	<body ng-app="trendsApp">
		<div ng-controller="keywordsController">
			
			<!-- Container -->
			<div class="container">
				<div growl></div>

				<!-- Notifications -->
				@include('layouts/notifications')
				<!-- ./ notifications -->

				<!-- Content -->
				@yield('content')
				<!-- ./ content -->
			</div>
			<!-- ./ container -->
		</div>
	</body>
</html>
