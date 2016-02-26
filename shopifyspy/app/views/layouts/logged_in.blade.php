<!DOCTYPE html>
<html lang="en-US">
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


  <script src="{{ asset('js/jquery-2.0.2.min.js') }}"></script>
  <!--<script src="{{ asset('piluku-html/assets/js/jquery.js') }}"></script> --> 
  <!-- // <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script> -->
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/restfulizer.js') }}"></script> 
  <script src="{{ asset('bower_components/angular/angular.js') }}"></script>

  <script src="{{ asset('js/ng-videosharing-embed.min.js') }}"></script>
  <script src="http://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.2.0.js"></script>
  
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
    jQuery(window).load(function () {
      $('.piluku-preloader').addClass('hidden');
    });
  </script>
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
          <img class="logo" src="{{ asset('piluku-html/assets/images/example.png') }}" alt="logo" style="padding-top:0px;"> 
        </div>
        <!-- logo-holder -->      
        <a href="#" class="menu-bar pull-right"><i class="ti-menu"></i></a>
      </div>
      <!-- admin-logo -->
      <ul class="list-unstyled menu-parent" id="mainMenu">
        <li {{ (Request::is('welcome') ? 'class="current"' : '') }}>
          <a href="/" class="waves-effect waves-light">
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
            <li><a href="{{ URL::to('media')}}#/@{{currentSearch}}">TShirt Research</a></li>
            <li><a href="{{ URL::to('products')}}#/@{{currentSearch}}">ECommerce Research</a></li>
          </ul>
        </li>
        <li {{ (Request::is('libraries') ? 'class="current"' : '') }}>
          <a href="{{ URL::to('libraries')}}" class="waves-effect waves-light">
            <i class="icon ti-briefcase"></i>
            <span class="text">My Library</span>
          </a>
        </li>
        <li>
          <a href="http://customerportal.co/itm/" target="_blank">
            <i class="icon ti-link"></i>
            <span class="text">Training</span>
          </a>
        </li>
        <li {{ (Request::is('users*') ? 'class="current"' : '') }}>
          <a href="{{ URL::to('/users') }}" class="waves-effect waves-light">
            <i class="icon ti-user"></i>
            <span class="text ">{{trans('pages.users')}}</span>
          </a>
        </li>
        <li {{ (Request::is('shopify*') ? 'class="current"' : '') }}>
          <a href="{{ URL::to('/shopify') }}" class="waves-effect waves-light">
            <i class="icon ti-wand"></i>
            <span class="text ">Shopify</span>
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
                <input type="text" class="form-control" placeholder="Search">
              </div>
            </form>
            <ul class="nav navbar-nav navbar-right top-elements">
              <li class="piluku-dropdown dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img class="flag_img" src="{{ asset('piluku-html/assets/images/flags/india-flag.jpg') }}" alt=""> English<span class="drop-icon"><i class="ion ion-chevron-down"></i></span>
                </a>
                <ul class="dropdown-menu dropdown-piluku-menu  animated fadeInUp wow language-drop neat_drop" data-wow-duration="1500ms" role="menu">
                  <li>
                    <a href="#"><img class="flag_img" src="{{ asset('piluku-html/assets/images/flags/gm.gif') }}" alt="flags"> German</a>
                  </li>
                  <li>
                    <a href="#"><img class="flag_img" src="{{ asset('piluku-html/assets/images/flags/usa.png') }}" alt="flags"> Spanish</a>
                  </li>
                  <li>
                    <a href="#"><img class="flag_img" src="{{ asset('piluku-html/assets/images/flags/gm.gif') }}" alt="flags"> german</a>
                  </li>
                  <li>
                    <a href="#"><img class="flag_img" src="{{ asset('piluku-html/assets/images/flags/gm.gif') }}" alt="flags"> german</a>
                  </li>
                </ul>
              </li>
              <li class="piluku-dropdown dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="ion-ios-bell-outline icon-notification"></i><span class="badge info-number message">22</span></a>
                <ul class="dropdown-menu dropdown-piluku-menu  animated fadeInUp wow notification-drop neat_drop dropdown-right" data-wow-duration="1500ms" role="menu">
                  <li>
                    <a href="profile.html">
                      <div class="hexagon danger">
                        <span><i class="ion-ios-alarm-outline"></i></span>
                      </div>
                      <span class="text_info"> Privacy settings have been changed</span>
                      <span class="time_info">3:30am</span>
                    </a>
                  </li>
                  <li>
                    <a href="profile.html">
                      <div class="hexagon success">
                        <span><i class="ion-ios-body-outline"></i></span>
                      </div>
                      <span class="text_info"> Tim has added you as friend</span>
                      <span class="time_info">4:30am</span>
                    </a>
                  </li>
                  <li>
                    <a href="profile.html">
                      <div class="hexagon warning">
                        <span><i class="ion-ios-cart-outline"></i></span>
                      </div>
                      <span class="text_info"> New item added</span>
                      <span class="time_info">6:07am</span>
                    </a>
                  </li>
                  <li>
                    <a href="profile.html">
                      <div class="hexagon info">
                        <span><i class="ion-ios-calendar-outline"></i></span>
                      </div>
                      <span class="text_info"> reminder please complete the task</span>
                      <span class="time_info">3:30pm</span>
                    </a>
                  </li>
                  <li>
                    <a href="profile.html">
                      <div class="outline-hexagon">
                        <span><i class="ion-ios-checkmark-outline"></i></span>
                      </div>
                      <span class="text_info"> Marked as complete</span>
                      <span class="time_info">1:30pm</span>
                    </a>
                  </li>
                  <li>
                    <a href="profile.html" class="last_info">See all notifications</a>
                  </li>

                </ul>
              </li>
              <li class="piluku-dropdown dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="ion-ios-box-outline icon-notification"></i><span class="badge info-number bell">22</span></a>
                <ul class="dropdown-menu dropdown-piluku-menu  animated fadeInUp wow message_drop neat_drop dropdown-right" data-wow-duration="1500ms" role="menu">
                  <li>
                    <a href="mailbox.html">
                      <div class="avatar_left"><img src="{{ asset('piluku-html/assets/images/avatar.jpeg') }}" alt=""></div>
                      <div class="info_right">
                        <span class="text_head pull-left">Megan fox</span>
                        <span class="time_info pull-right">3:30am <i class="online ion-record"></i></span>
                        <div class="text_info"> Hi want to know about the company freelance for wizard</div>
                      </div>              
                    </a>
                  </li>
                  <li>
                    <a href="mailbox.html">
                      <div class="avatar_left"><img src="{{ asset('piluku-html/assets/images/avatar.jpeg') }}" alt=""></div>
                      <div class="info_right">
                        <span class="text_head pull-left">Megan fox</span>
                        <span class="time_info pull-right">3:30am <i class="online ion-record"></i></span>
                        <div class="text_info"> Hi want to know about the company freelance for wizard</div>
                      </div>              
                    </a>
                  </li>
                  <li>
                    <a href="mailbox.html">
                      <div class="avatar_left"><img src="{{ asset('piluku-html/assets/images/avatar.jpeg') }}" alt=""></div>
                      <div class="info_right">
                        <span class="text_head pull-left">Megan fox</span>
                        <span class="time_info pull-right">3:30am <i class="online ion-record"></i></span>
                        <div class="text_info"> Hi want to know about the company freelance for wizard</div>
                      </div>  
                    </a>
                  </li>
                  <li>
                    <a href="mailbox.html">
                      <div class="avatar_left"><img src="{{ asset('piluku-html/assets/images/avatar.jpeg') }}" alt=""></div>
                      <div class="info_right">
                        <span class="text_head pull-left">Megan fox</span>
                        <span class="time_info pull-right">3:30am <i class="online ion-record"></i></span>
                        <div class="text_info"> Hi want to know about the company freelance for wizard</div>
                      </div>  
                    </a>
                  </li>
                </ul>
              </li>
              <li class="piluku-dropdown dropdown">
                <!-- @todo Change design here, its bit of odd or not upto usable -->

                <a href="#" class="dropdown-toggle avatar_width" data-toggle="dropdown" role="button" aria-expanded="false">
                  <span class="avatar-holder"><img src="{{ asset('piluku-html/assets/images/avatar/one.png') }}" alt=""></span>
                  <span class="avatar_info">
                    {{ Session::get('email') }}                    
                  </span>
                  <span class="drop-icon"><i class="ion ion-chevron-down"></i></span></a>

                
                <ul class="dropdown-menu dropdown-piluku-menu  animated fadeInUp wow avatar_drop neat_drop dropdown-right" data-wow-duration="1500ms" role="menu">
                  <li>
                    <a href="{{ URL::to('/users') }}"> <i class="ion-android-settings"></i>{{trans('pages.users')}}</a>
                  </li>
                  <li>
                    <a href="{{ action('UserController@edit', Session::get('userId') ) }}"> <i class="ion-android-create"></i>Edit profile</a>
                  </li>
                  <li>
                    <a href="{{ URL::to('logout') }}" class="logout_button"><i class="ion-power"></i>Logout</a>
                  </li>   
                </ul>
              </li>
              <li class="chat_btn">
                <a href="#" class="right-bar-toggle flatRed">
                  <i class="ion-ios-people-outline"></i>                              
                </a>
              </li>
            </ul>
          </nav>
        </div>
        <!-- /top-bar -->
  
        <!-- main content -->
        <div class="main-content" ng-controller="keywordsController">
          <!-- Content -->
          @yield('content')
          <!-- ./ content -->
        </div>
        <!-- /main content -->
    </div>

    <div class="side-bar right-bar ">
      <div class="contacts">
        <div class="col col-md-12">
          <ul class="tabs">
            <li class="tab col-md-3"><a href="#test1" class="active">Chat</a></li>
            <li class="tab col-md-3"><a href="#test2">Settings</a></li>
            <li class="tab col-md-3"><a href="#test3">Messages</a></li>
          </ul>
        </div>
        <div class="content-holder">
          <div id="test1" class="col-md-12 no_padding">         
            <div class="panel-body no_padding">
              <div class="panel-group piluku-accordion piluku-accordion-two" id="accordionOne" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="headingModalOne">
                    <h4 class="panel-title">
                      <a class="collapsed" data-toggle="collapse" data-parent="#accordionOne" href="#collapseModalOne" aria-expanded="true" aria-controls="collapseOne">
                        Online <i class="chevron ti-angle-down"></i>
                      </a>
                    </h4>
                  </div>
                  <div id="collapseModalOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body no_padding">
                      <ul class="list-group contacts-list">
                        <li class="list-group-item">
                          <a href="#">
                            <div class="avatar">
                              <img src="{{ asset('piluku-html/assets/images/avatar/one.png') }}" alt="">
                            </div>
                            <span class="name">Richards carlson</span>
                            <i class="ion ion-record online"></i>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <a href="#">
                            <div class="avatar">
                              <img src="{{ asset('piluku-html/assets/images/avatar/two.png') }}" alt="">
                            </div>
                            <span class="name">Firing Arc</span>
                            <i class="ion ion-record online"></i>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <a href="#">
                            <div class="avatar">
                              <img src="{{ asset('piluku-html/assets/images/avatar/three.png') }}" alt="">
                            </div>
                            <span class="name">strapzen</span>
                            <i class="ion ion-record online"></i>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <a href="#">
                            <div class="avatar">
                              <img src="{{ asset('piluku-html/assets/images/avatar/four.png') }}" alt="">
                            </div>
                            <span class="name">Reeves</span>
                            <i class="ion ion-record online"></i>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <a href="#">
                            <div class="avatar">
                              <img src="{{ asset('piluku-html/assets/images/avatar/five.png') }}" alt="">
                            </div>
                            <span class="name">Bootstrap Guru</span>
                            <i class="ion ion-record online"></i>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <a href="#">
                            <div class="avatar">
                              <img src="{{ asset('piluku-html/assets/images/avatar/six.png') }}" alt="">
                            </div>
                            <span class="name">Carlson</span>
                            <i class="ion ion-record online"></i>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <a href="#">
                            <div class="avatar">
                              <img src="{{ asset('piluku-html/assets/images/avatar/seven.png') }}" alt="">
                            </div>
                            <span class="name">Paris hilton</span>
                            <i class="ion ion-record online"></i>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <a href="#">
                            <div class="avatar">
                              <img src="{{ asset('piluku-html/assets/images/avatar/eight.png') }}" alt="">
                            </div>
                            <span class="name">Henry Richards</span>
                            <i class="ion ion-record online"></i>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <a href="#">
                            <div class="avatar">
                              <img src="{{ asset('piluku-html/assets/images/avatar/nine.png') }}" alt="">
                            </div>
                            <span class="name">Richie Rich</span>
                            <i class="ion ion-record online"></i>
                          </a>
                        </li>

                      </ul> 
                    </div>
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="headingModalTwo">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordionOne" href="#collapseModalTwo" aria-expanded="false" aria-controls="collapseTwo">
                        offline
                      </a>
                    </h4>
                  </div>
                  <div id="collapseModalTwo" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingTwo">
                    
                    <div class="panel-body no_padding">
                      <ul class="list-group contacts-list">
                        <li class="list-group-item">
                          <a href="#">
                            <div class="avatar">
                              <img src="{{ asset('piluku-html/assets/images/avatar/one.png') }}" alt="">
                            </div>
                            <span class="name">Richards carlson</span>
                            <i class="ion ion-record offline"></i>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <a href="#">
                            <div class="avatar">
                              <img src="{{ asset('piluku-html/assets/images/avatar/two.png') }}" alt="">
                            </div>
                            <span class="name">Firing Arc</span>
                            <i class="ion ion-record offline"></i>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <a href="#">
                            <div class="avatar">
                              <img src="{{ asset('piluku-html/assets/images/avatar/three.png') }}" alt="">
                            </div>
                            <span class="name">strapzen</span>
                            <i class="ion ion-record offline"></i>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <a href="#">
                            <div class="avatar">
                              <img src="{{ asset('piluku-html/assets/images/avatar/four.png') }}" alt="">
                            </div>
                            <span class="name">Reeves</span>
                            <i class="ion ion-record offline"></i>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <a href="#">
                            <div class="avatar">
                              <img src="{{ asset('piluku-html/assets/images/avatar/five.png') }}" alt="">
                            </div>
                            <span class="name">Bootstrap Guru</span>
                            <i class="ion ion-record offline"></i>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <a href="#">
                            <div class="avatar">
                              <img src="{{ asset('piluku-html/assets/images/avatar/six.png') }}" alt="">
                            </div>
                            <span class="name">Carlson</span>
                            <i class="ion ion-record offline"></i>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <a href="#">
                            <div class="avatar">
                              <img src="{{ asset('piluku-html/assets/images/avatar/seven.png') }}" alt="">
                            </div>
                            <span class="name">Paris hilton</span>
                            <i class="ion ion-record offline"></i>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <a href="#">
                            <div class="avatar">
                              <img src="{{ asset('piluku-html/assets/images/avatar/eight.png') }}" alt="">
                            </div>
                            <span class="name">Henry Richards</span>
                            <i class="ion ion-record offline"></i>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <a href="#">
                            <div class="avatar">
                              <img src="{{ asset('piluku-html/assets/images/avatar/nine.png') }}" alt="">
                            </div>
                            <span class="name">Richie Rich</span>
                            <i class="ion ion-record offline"></i>
                          </a>
                        </li>

                      </ul> 
                    </div>
                    
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="headingModalThree">
                    <h4 class="panel-title">
                      <a class="collapsed" data-toggle="collapse" data-parent="#accordionOne" href="#collapseModalThree" aria-expanded="false" aria-controls="collapseThree">
                        Away
                      </a>
                    </h4>
                  </div>
                  <div id="collapseModalThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">                  
                    <div class="panel-body no_padding">
                      <ul class="list-group contacts-list">
                        <li class="list-group-item">
                          <a href="#">
                            <div class="avatar">
                              <img src="{{ asset('piluku-html/assets/images/avatar/one.png') }}" alt="">
                            </div>
                            <span class="name">Richards carlson</span>
                            <i class="ion ion-record away"></i>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <a href="#">
                            <div class="avatar">
                              <img src="{{ asset('piluku-html/assets/images/avatar/two.png') }}" alt="">
                            </div>
                            <span class="name">Firing Arc</span>
                            <i class="ion ion-record away"></i>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <a href="#">
                            <div class="avatar">
                              <img src="{{ asset('piluku-html/assets/images/avatar/three.png') }}" alt="">
                            </div>
                            <span class="name">strapzen</span>
                            <i class="ion ion-record away"></i>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <a href="#">
                            <div class="avatar">
                              <img src="{{ asset('piluku-html/assets/images/avatar/four.png') }}" alt="">
                            </div>
                            <span class="name">Reeves</span>
                            <i class="ion ion-record away"></i>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <a href="#">
                            <div class="avatar">
                              <img src="{{ asset('piluku-html/assets/images/avatar/five.png') }}" alt="">
                            </div>
                            <span class="name">Bootstrap Guru</span>
                            <i class="ion ion-record away"></i>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <a href="#">
                            <div class="avatar">
                              <img src="{{ asset('piluku-html/assets/images/avatar/six.png') }}" alt="">
                            </div>
                            <span class="name">Carlson</span>
                            <i class="ion ion-record away"></i>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <a href="#">
                            <div class="avatar">
                              <img src="{{ asset('piluku-html/assets/images/avatar/seven.png') }}" alt="">
                            </div>
                            <span class="name">Paris hilton</span>
                            <i class="ion ion-record away"></i>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <a href="#">
                            <div class="avatar">
                              <img src="{{ asset('piluku-html/assets/images/avatar/eight.png') }}" alt="">
                            </div>
                            <span class="name">Henry Richards</span>
                            <i class="ion ion-record away"></i>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <a href="#">
                            <div class="avatar">
                              <img src="{{ asset('piluku-html/assets/images/avatar/nine.png') }}" alt="">
                            </div>
                            <span class="name">Richie Rich</span>
                            <i class="ion ion-record away"></i>
                          </a>
                        </li>
                      </ul> 
                    </div>
                  </div>
                </div>
              </div>  
            </div> 
          </div>
          <div id="test2" class="col-md-12 no_padding">
          <br>                    
            <div class="form-group">
              <div class="toggle-switch">
                <label class="col-sm-8 control-label">Reminders</label>
                <div class="col-sm-4">
                  <input type="checkbox" class="mark-complete" id="toggle-switch" name="" value="" checked="">
                  <div class="toggle">
                    <label for="toggle-switch"><i></i>
                    </label>
                  </div>
                </div>
              </div>
              <div class="toggle-switch">
                <label class="col-sm-8 control-label">theme options</label>
                <div class="col-sm-4">
                  <input type="checkbox" class="mark-complete" id="toggle-switch1" name="" value="" checked="">
                  <div class="toggle">
                    <label for="toggle-switch1"><i></i>
                    </label>
                  </div>
                </div>
              </div>
              <div class="toggle-switch">
                <label class="col-sm-8 control-label">dark / light theme</label>
                <div class="col-sm-4">
                  <input type="checkbox" class="mark-complete" id="toggle-switch2" name="" value="" checked="">
                  <div class="toggle">
                    <label for="toggle-switch2"><i></i>
                    </label>
                  </div>
                </div>
              </div>
              <div class="toggle-switch">
                <label class="col-sm-8 control-label">Email Updates</label>
                <div class="col-sm-4">
                  <input type="checkbox" class="mark-complete" id="toggle-switch3" name="" value="" checked="">
                  <div class="toggle">
                    <label for="toggle-switch3"><i></i>
                    </label>
                  </div>
                </div>
              </div>
              <div class="toggle-switch">
                <label class="col-sm-8 control-label">Notifications</label>
                <div class="col-sm-4">
                  <input type="checkbox" class="mark-complete" id="toggle-switch4" name="" value="" checked="">
                  <div class="toggle">
                    <label for="toggle-switch4"><i></i>
                    </label>
                  </div>
                </div>
              </div>              

              <div class="form-group check-radio">
                <label class="col-sm-9 control-label">Loader animation</label>
                <div class="col-sm-3">
                  <ul class="list-inline checkboxes-radio">
                    <li class="ms-hover">
                      <input type="checkbox" class="mark-complete" id="c1">
                      <label for="c1"><span></span></label>
                    </li>                                                                               
                  </ul>
                </div>
              </div>
              <div class="form-group check-radio">
                <label class="col-sm-9 control-label">delay load</label>
                <div class="col-sm-3">
                  <ul class="list-inline checkboxes-radio">
                    <li class="ms-hover">
                      <input type="checkbox" class="mark-complete" id="c2">
                      <label for="c2"><span></span></label>
                    </li>                                                                               
                  </ul>
                </div>
              </div>
              <div class="form-group check-radio">
                <label class="col-sm-9 control-label">Graphs animations</label>
                <div class="col-sm-3">
                  <ul class="list-inline checkboxes-radio">
                    <li class="ms-hover">
                      <input type="checkbox" class="mark-complete" id="c3" checked="">
                      <label for="c3"><span></span></label>
                    </li>                                                                               
                  </ul>
                </div>
              </div>
            </div>            
          </div>
          <div id="test3" class="col-md-12 no_padding">
            <div class="heading no_border_bottom">
              Todays
              <div class="left"><a href="#"><i class="ion-android-refresh"></i></a></div>
              <div class="right"><a href="#"><i class="ion-gear-a"></i></a></div>           
            </div>
            <div class="list-group message-list">
              <a href="#" class="list-group-item">
                <h4 class="list-group-item-heading">henry richards</h4>
                <p class="list-group-item-text">has pushed all the code to github and saved some fixes too..</p>
              </a>
              <a href="#" class="list-group-item">
                <h4 class="list-group-item-heading">mary </h4>
                <p class="list-group-item-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto accusamus officiis vero magnam amet, quas corru</p>
              </a>              
            </div>  
            <div class="heading no_border_bottom">
              june 15 1990
              <div class="left"><a href="#"><i class="ion-android-refresh"></i></a></div>
              <div class="right"><a href="#"><i class="ion-gear-a"></i></a></div>           
            </div>
            <div class="list-group message-list">
              <a href="#" class="list-group-item">
                <h4 class="list-group-item-heading">henry richards</h4>
                <p class="list-group-item-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto accusamus officiis vero magnam amet, quas corru</p>
              </a>
              <a href="#" class="list-group-item">
                <h4 class="list-group-item-heading">mary </h4>
                <p class="list-group-item-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto accusamus officiis vero magnam amet, quas corru</p>
              </a>              
            </div>  
          </div>
        </div>
        <!-- content_holder -->
      </div>
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

  <script src="{{ asset('piluku-html/assets/js/jquery.countTo.js') }}"></script>

  @yield('otherScript')
</body>
</html>