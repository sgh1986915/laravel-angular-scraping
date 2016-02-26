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

		<link rel="stylesheet" type="text/css" href="//bootswatch.com/yeti/bootstrap.min.css">

		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

		<script type="text/javascript" src="http://www.google.com/jsapi"></script>

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
		<script src="{{ asset('js/jquery-2.0.2.min.js') }}"></script>
		<script src="{{ asset('js/bootstrap.min.js') }}"></script>
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
			<!-- Navbar -->
			<div class="navbar navbar-default navbar-fixed-top">
		      <div class="container">
		        <div class="navbar-header">
		          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		          </button>
		          <a class="navbar-brand" href="{{ URL::route('home') }}">{{trans('pages.name')}}</a>
		        </div>
		        <div class="collapse navbar-collapse">
		          <ul class="nav navbar-nav">
		          	@if (Sentry::check())
		          	<li {{ (Request::is('top-trending') ? 'class="active"' : '') }}><a href="{{ URL::to('welcome')}}">Home</a></li>
		          	<li {{ (Request::is('search') ? 'class="active dropdown"' : 'class="dropdown"') }}>
		          		<a href="{{ URL::to('search')}}#/@{{currentSearch}}">Find Trends</a>
		          		<ul class="dropdown-menu">
				        	<li><a href="{{ URL::to('media')}}#/@{{currentSearch}}">TShirt Research</a></li>
		          			<li><a href="{{ URL::to('products')}}#/@{{currentSearch}}">ECommerce Research</a></li>
				        </ul>
		          	</li>
		          	<!--<li {{ (Request::is('media') ? 'class="active"' : '') }}><a href="{{ URL::to('media')}}#/@{{currentSearch}}">TShirt Research</a></li>
		          	<li {{ (Request::is('products') ? 'class="active"' : '') }}><a href="{{ URL::to('products')}}#/@{{currentSearch}}">ECommerce Research</a></li>-->
		          	<li {{ (Request::is('libraries') ? 'class="active"' : '') }}><a href="{{ URL::to('libraries')}}">My Library</a></li>
		          	<li {{ (Request::is('libraries') ? 'class="active"' : '') }}><a href="http://customerportal.co/itm/" target="_blank">Training</a></li>
		          	@endif
					@if (Sentry::check() && Sentry::getUser()->hasAccess('admin'))
					<li {{ (Request::is('users*') ? 'class="active"' : '') }}><a href="{{ URL::to('/users') }}">{{trans('pages.users')}}</a></li>
					<!--<li {{ (Request::is('groups*') ? 'class="active"' : '') }}><a href="{{ URL::to('/groups') }}">{{trans('pages.groups')}}</a></li>-->
					@endif
		          </ul>
		          <ul class="nav navbar-nav navbar-right">
		            @if (Sentry::check())
					<li {{ (Request::is('users/'. Session::get('userId')) ? 'class="active"' : '') }}><a href="{{ action('UserController@edit', Session::get('userId') ) }}">{{ Session::get('email') }}</a></li>
					<li><a href="{{ URL::to('logout') }}">{{trans('pages.logout')}}</a></li>
					@else
					<li {{ (Request::is('login') ? 'class="active"' : '') }}><a href="{{ URL::to('login') }}">{{trans('pages.login')}}</a></li>
					@endif
		          </ul>
		        </div><!--/.nav-collapse -->
		      </div>
		    </div>
			<!-- ./ navbar -->

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
