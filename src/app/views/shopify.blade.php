@extends('layouts.piluku')

{{-- Web site Title --}}
@section('title')
@parent
 - {{trans('pages.searchTitle')}}
@stop

{{-- Content --}}
@section('content')

@include('layouts.search_input')

<div class="row" ng-init="initShopify()">

	<div class="col-md-2">		
		<div class="list-group">
			<span class="list-group-item">
				<h4 class="list-group-item-heading">Categories</h4>
			</span>
			<a href="#" ng-repeat="cat in categoryData" class="list-group-item" ng-click="clickShopifyCategory(cat.title, cat.url)">@{{cat.title}}</a>
		</div>
	</div>

	<div class="col-md-10">
		<a href="@{{site.url}}" ng-repeat="site in siteData">@{{site.title}}</a>
	</div>
	
</div>

@stop
