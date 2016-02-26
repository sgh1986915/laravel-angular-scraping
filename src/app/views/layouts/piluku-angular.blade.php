<!doctype html>
<!-- Our PilukuApp module defined here -->
<html lang="en" ng-app="PilukuApp">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/> <!--320-->
    <!-- using twitter bootstrap, but of course -->

    <link rel="stylesheet" type="text/css" href="{{ asset('css/mystyles.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('piluku-angular/assets/css/bootstrap.min.css') }}">
    <!-- styles for ng-animate are located here -->
    <link rel="stylesheet" type="text/css" href="{{ asset('piluku-angular/assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('piluku-angular/assets/css/loading-bar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('piluku-angular/assets/css/material.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('piluku-angular/assets/css/styles.css') }}">
  
    <!-- Include Jquery file -->
    <script src="{{ asset('piluku-angular/assets/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('piluku-angular/assets/js/materialize.min.js') }}"></script>
    
    <!-- // <script src="{{ asset('piluku-angular/assets/js/bootstrap.js') }}"></script> -->
    <script type="text/javascript">
    appHelper   = {
          
          componentsDir: 'app/modules',
          assetsDir: 'assets',

          componentView: function(componentName,viewName)
          {
            return this.componentsDir + '/' + componentName + '/views/' + viewName +'.html' ;
          },
          componentJs: function(componentName,jsName)
          {
            return this.componentsDir + '/' + componentName + '/js/' + jsName +'.js' ;
          },
          componentData: function(componentName,dataName)
          {
            return this.componentsDir + '/' + componentName + '/data/' + dataName +'.json' ;
          },

          assetPath: function(file_path)
          {
            return this.assetsDir + '/' + file_path;
          }
        };
    </script>
    <!-- could easily use a custom property of the state here instead of 'name' -->
    <title>Piluku - Twitter Bootstrap Admin Template </title>
  </head>
  
  <body ng-controller="MainCtrl">
    <div class="wrapper" ng-class="{'mini-bar': $storage.miniSidebar}">
      <ui-view></ui-view>
    </div>
    <!-- wrapper -->

    <!-- Include angular.js, angular-animate.js and angular-ui-router.js-->
    <script src="{{ asset('piluku-angular/assets/libs/angular/angular.min.js') }}"></script>
    <script src="{{ asset('piluku-angular/assets/libs/angular/angular-animate.min.js') }}"></script>
    <script src="{{ asset('piluku-angular/assets/libs/angular-ui.js') }}"></script>
    <script src="{{ asset('piluku-angular/assets/libs/ocLazyLoad.js') }}"></script>
    <script src="{{ asset('piluku-angular/assets/js/loading-bar.js') }}"></script>
    
    <script src="{{ asset('piluku-angular/app/modules/maps/js/lodash.js') }}"></script>
    <script src="{{ asset('piluku-angular/app/modules/maps/js/angular-google-maps.js') }}"></script>

    <!-- app.js declares the PilukuApp module and adds items to $rootScope, and defines
         the "home" and "about" states
    -->
    <script src="{{ asset('piluku-angular/app/app.routes.js') }}"></script>
    <script src="{{ asset('piluku-angular/app/app.controllers.js') }}"></script>
    <script src="{{ asset('piluku-angular/assets/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('piluku-angular/assets/js/jquery.nicescroll.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('piluku-angular/assets/js/jquery.accordion.js') }}"></script>
    <script type="text/javascript" src="{{ asset('piluku-angular/assets/js/wow.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('piluku-angular/assets/js/jquery.loadmask.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('piluku-angular/assets/js/ngStorage.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('piluku-angular/assets/js/jquery.countTo.js') }}"></script>

    <!-- // <script src="{{ asset('piluku-angular/assets/js/core.js') }}"></script>  -->

    <!-- contacts.js declares the PilukuApp.contacts module, and adds a number of contact
         related states 
    -->
    <script src="{{ asset('piluku-angular/app/modules/contacts/js/contacts.js') }}"></script>

    <!-- contacts-service.js, and utils-service.js define services for use by the 
         PilukuApp.contacts module.
    -->
    <script src="{{ asset('piluku-angular/app/modules/contacts/js/contacts-service.js') }}"></script>
    <script src="{{ asset('piluku-angular/app/modules/contacts/js/utils-service.js') }}"></script>

  </body>
</html>