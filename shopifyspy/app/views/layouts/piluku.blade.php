<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/> <!--320-->

  <title>
    @section('title') 
    {{trans('pages.name')}}
    @show
  </title>

  <!-- <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="images/favicon.ico" type="image/x-icon"> -->
  <!-- Bootstrap CSS -->

  <link rel='stylesheet' href="{{ asset('piluku-html/assets/css/bootstrap.min.css') }}">
  <link rel='stylesheet' href="{{ asset('piluku-html/assets/css/material.css') }}">
  <link rel='stylesheet' href="{{ asset('piluku-html/assets/css/style.css') }}">

  <link rel="stylesheet" type="text/css" href="{{ asset('css/messenger.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/messenger-theme-future.css') }}">

  <link rel="stylesheet" href="{{ asset('bower_components/angular-loading-bar/build/loading-bar.css') }}">
  <link rel="stylesheet" href="{{ asset('bower_components/angular-bootstrap-lightbox/dist/angular-bootstrap-lightbox.css') }}">

  
  <script src="{{ asset('js/jquery-2.0.2.min.js') }}"></script>


  <script src="{{ asset('bower_components/angular/angular.js') }}"></script>
    
  <script src="{{ asset('js/ng-videosharing-embed.min.js') }}"></script>
  <script src="http://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.2.0.js"></script>
  
  <script type="text/javascript" src="http://www.google.com/jsapi"></script>

  <script src="{{ asset('js/messenger.min.js') }}"></script>
  <script src="{{ asset('js/messenger-theme-future.js') }}"></script>
  <script src="{{ asset('js/popup.js') }}"></script>
  <script src="{{ asset('js/script.js') }}"></script>
  <script src="{{ asset('js/app.js') }}"></script>

  <script src="{{ asset('bower_components/angular-touch/angular-touch.js') }}"></script>
  <script src="{{ asset('bower_components/angular-bootstrap/ui-bootstrap-tpls.js') }}"></script>
  <script src="{{ asset('bower_components/angular-loading-bar/build/loading-bar.js') }}"></script>
  <script src="{{ asset('bower_components/angular-bootstrap-lightbox/dist/angular-bootstrap-lightbox.js') }}"></script>

  <script>
    google.load("visualization", "1", {packages:["corechart"]});

    jQuery(window).load(function () {
      $('.piluku-preloader').addClass('hidden');
    });
  </script>

  <style type="text/css">
    a.list-group-item{ cursor: pointer }
    .list-group .list-group-item.active{ color:#fff; }
    div.imgContainer:hover{ background-color: #fff !important; cursor: pointer }
    img.imag{ max-width:100%;}
    img.imag:hover{ cursor: pointer; }
  </style>
</head>
<body class="" ng-app="trendsApp">

  <div class="piluku-preloader text-center">
    <!-- <div class="progress">
        <div class="indeterminate"></div>
    </div> -->
    <div class="loader">Loading...</div>
  </div>
  
  <div class="wrapper ">
    <div class="left-bar ">
      <div class="admin-logo">
        <div class="logo-holder pull-left">
          <img class="logo" src="{{ asset('piluku-html/assets/images/example.png') }}" alt="logo"> 
        </div>
        <!-- logo-holder -->      
        <a href="#" class="menu-bar pull-right"><i class="ti-menu"></i></a>
      </div>

      <!-- admin-logo -->
      <ul class="list-unstyled menu-parent" id="mainMenu">
        <li {{ (Request::is('welcome') ? 'class="current"' : '') }}>
          <a href="/" class="{{ (Request::is('welcome') ? 'current' : '') }} waves-effect waves-light">
            <i class="icon ti-home"></i>
            <span class="text ">Dashboard</span>
          </a>
        </li>
        <li class="submenu">
          <a class="waves-effect waves-light" href="#layouts">
            <i class="icon ti-layout"></i>
            <span class="text">Find Trends</span>
            <i class="chevron ti-angle-right"></i>
          </a>
          <ul class="list-unstyled">
            <li><a href="{{ URL::to('search')}}#/@{{currentSearch}}">Trending Now</a></li>
            <li><a href="{{ URL::to('media')}}#/@{{currentSearch}}">TShirt Research</a></li>
            <li><a href="{{ URL::to('products')}}#/@{{currentSearch}}">ECommerce Research</a></li>
          </ul>
        </li>
        <li {{ (Request::is('libraries') ? 'class="current"' : '') }}>
          <a href="{{ URL::to('libraries')}}" class="{{ (Request::is('libraries') ? 'current' : '') }} waves-effect waves-light">
            <i class="icon ti-briefcase"></i>
            <span class="text">My Favorites</span>
          </a>
        </li>
        <li>
          <a href="http://customerportal.co/itm/" target="_blank">
            <i class="icon ti-link"></i>
            <span class="text">Training</span>
          </a>
        </li>
        @if (Sentry::check() && Sentry::getUser()->hasAccess('admin'))
        <li {{ (Request::is('users*') ? 'class="current"' : '') }}>
          <a href="{{ URL::to('/users') }}" class="{{ (Request::is('users*') ? 'current' : '') }} waves-effect waves-light">
            <i class="icon ti-user"></i>
            <span class="text ">{{trans('pages.users')}}</span>
          </a>
        </li>
        @endif
        <li {{ (Request::is('shopify*') ? 'class="current"' : '') }}>
          <a href="{{ URL::to('/shopify') }}" class="{{ (Request::is('shopify*') ? 'current' : '') }} waves-effect waves-light">
            <i class="icon ti-wand"></i>
            <span class="text ">Shopify</span>
          </a>
        </li>
        <li {{ (Request::is('watchcount*') ? 'class="current"' : '') }}>
          <a href="{{ URL::to('/watchcount') }}" class="{{ (Request::is('watchcount*') ? 'current' : '') }} waves-effect waves-light">
            <i class="icon ti-eye"></i>
            <span class="text ">Watch Count</span>
          </a>
        </li>
        <li {{ (Request::is('wanelo*') ? 'class="current"' : '') }}>
          <a href="{{ URL::to('/wanelo') }}" class="{{ (Request::is('wanelo*') ? 'current' : '') }} waves-effect waves-light">
            <i class="icon ti-cut"></i>
            <span class="text ">Wanelo</span>
          </a>
        </li>
      </ul>
      
    </div>

    <!-- left-bar -->

    <div class="content" id="content">
      <div class="overlay"></div>
        <div class="top-bar">
          <nav class="navbar navbar-default top-bar">
            <div class="menu-bar-mobile" id="open-left"><i class="ti-menu"></i>
            </div>

            <form class="navbar-left" role="search">
              <div class="search">
                <input type="text" class="form-control" placeholder="Trend Research">
              </div>
            </form>
            <ul class="nav navbar-nav navbar-right top-elements">                  
              <li class="piluku-dropdown dropdown">
              
                <!-- @todo Change design here, its bit of odd or not upto usable -->

                <a class="dropdown-toggle avatar_width" data-toggle="dropdown" role="button" aria-expanded="false"><span class="avatar-holder"><img src="{{ asset('piluku-html/assets/images/avatar.jpeg') }}" alt=""></span><span class="avatar_info">{{ Session::get('email') }}</span><span class="drop-icon"><!-- <i class="ion ion-chevron-down"></i> --></span></a>
                <ul class="dropdown-menu dropdown-piluku-menu  animated fadeInUp wow avatar_drop neat_drop dropdown-right" data-wow-duration="1500ms" role="menu">
                  
                  <li>
                    <a href="{{ action('UserController@edit', Session::get('userId') ) }}"> <i class="ion-android-create"></i>Edit profile</a>
                  </li>
                  <li>
                    <a href="{{ URL::to('logout') }}" class="logout_button"><i class="ion-power"></i>Logout</a>
                  </li>   
                </ul>
              </li>
            </ul>
          </nav>
        </div>
        <!-- /top-bar -->
    
          <!-- Page Header -->
        @if(Route::current()->getName() != 'home' && Route::current()->getName() != 'welcome') 
        <div class="page_header" style="min-height: 75px !important;margin-bottom: 10px;">
            <div class="pull-left">              

              <?php
                $currPage = Route::current()->getName();
                $_title = '';
                switch($currPage){
                  case 'search'       : $_title = 'Trending Now'; break;
                  case 'media.search' : $_title = 'TShirt Research'; break;
                  case 'product.search': $_title = 'ECommerce Research'; break;
                  case 'shopify'      : $_title = 'Shopify'; break;
                  case 'watchcount'   : $_title = 'Find Products To Sell'; break;
                  case 'wanelo'       : $_title = 'Wanelo'; break;
                }

              ?>
              <span class="main-text" style="font-size:25px;">{{ $_title }}</span> 

          </div>
        </div> 
        @endif
        <!-- /pageheader -->

        <!-- main content -->
        <div class="main-content" ng-controller="keywordsController">
          <!-- Content -->
          @yield('content')
          <!-- ./ content -->
        </div>
        <!-- /main content -->
    </div>

    
    <!-- /Right-bar -->
  </div>
  <!-- wrapper -->

  <script src="{{ asset('piluku-html/assets/js/jquery-ui-1.10.3.custom.min.js') }}"></script>
  <script src="{{ asset('piluku-html/assets/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('piluku-html/assets/js/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('piluku-html/assets/js/wow.min.js') }}"></script>
  <script src="{{ asset('piluku-html/assets/js/jquery.loadmask.min.js') }}"></script>
  <script src="{{ asset('piluku-html/assets/js/jquery.accordion.js') }}"></script>
  <script src="{{ asset('piluku-html/assets/js/materialize.js') }}"></script>
  <script src="{{ asset('piluku-html/assets/js/bic_calendar.js') }}"></script>
  <script src="{{ asset('piluku-html/assets/js/core.js') }}"></script>

  @if(Route::current()->getName() == 'wanelo') 
   <!-- datatables -->
  <script src="{{ asset('piluku-html/assets/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('piluku-html/assets/js/bootstrap-datatables.js') }}"></script>  
  <script src="{{ asset('piluku-html/assets/js/dataTables-custom.js') }}"></script>
  <script src="{{ asset('piluku-html/assets/js/mindmup-editabletable.js') }}"></script>
  <script src="{{ asset('piluku-html/assets/js/numeric-input-example.js') }}"></script>
  <script src="{{ asset('piluku-html/assets/js/dynamic-tables.js') }}"></script>
  @endif

  <script src="{{ asset('piluku-html/assets/js/jquery.countTo.js') }}"></script>

  @yield('otherScript')
</body>
</html>