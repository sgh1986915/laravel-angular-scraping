@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
 - {{trans('pages.mediaTitle')}}
@stop

{{-- Content --}}
@section('content')

@include('layouts.search_input')

<div class="row" ng-init="initMedia()">

	<div class="col-xs-2">		
		<div class="list-group">
			<span class="list-group-item">
				<h4 class="list-group-item-heading">Favorites</h4>
			</span>
			<a ng-repeat="favorite in favoritesData" ng-class="{ 'active' : search == favorite.keyword}" ng-click="clickKeywordMedia(favorite.keyword)" class="list-group-item">
			@{{favorite.keyword}}</a>
		</div>
	</div>

	<div ng-if="search" class="col-xs-10">
		
		<div class="row">
			<div class="col-xs-12">
				<ul id="kwTabs" class="nav nav-tabs" role="tablist">
					<li><a data-target="#kwImages" role="tab" data-toggle="tab">Images</a></li>
					<li><a data-target="#kwSkreened" role="tab" data-toggle="tab">Skreened</a></li>
					<li><a data-target="#kwCafepress" role="tab" data-toggle="tab">Cafepress</a></li>
					<li><a data-target="#kwZazzle" role="tab" data-toggle="tab">Zazzle</a></li>
					<li><a data-target="#kwPinterest" role="tab" data-toggle="tab" id="pinterestButton">Pinterest</a></li>
				</ul>			
			</div>			
		</div>
			
		<div class="tab-content">

			<div id="kwImages" class="tab-pane fade">
				<div class="row">
					<div class="col-xs-3">
						<ul class="nav nav-tabs nav-stacked" role="tablist">
							<li class="active"><a role="tab" data-toggle="tab" ng-click="loadImages(search)">@{{currentSearch}}</a></li>
							<li><a role="tab" data-toggle="tab" ng-click="loadImages(currentSearch + ' funny images')">Funny Images</a></li>
							<li><a role="tab" data-toggle="tab" ng-click="loadImages(currentSearch + ' t-shirt designs')">Tshirt Designs</a></li>
							<li><a role="tab" data-toggle="tab" ng-click="loadImages(currentSearch + ' t-shirt and hoodies')">Tshirt & Hoodies</a></li>
							<li><a role="tab" data-toggle="tab" ng-click="loadImages(currentSearch + ' gift ideas')">Gift Ideas</a></li>
							<li><a role="tab" data-toggle="tab" ng-click="loadImages(currentSearch + ' quotes')">Quotes</a></li>
							<li><a role="tab" data-toggle="tab" ng-click="loadImages(currentSearch + ' sayings')">Sayings</a></li>
							<li><a role="tab" data-toggle="tab" ng-click="loadImages(currentSearch + ' womens tshirts')">Womens Tshirts</a></li>
							<li><a role="tab" data-toggle="tab" ng-click="loadImages(currentSearch + ' mens tshirts')">Mens Tshirts</a></li>
							<li><a role="tab" data-toggle="tab" ng-click="loadImages(currentSearch + ' jokes')">Jokes</a></li>
							<li><a role="tab" data-toggle="tab" ng-click="loadImages('funny ' + currentSearch + ' t-shirt')">Funny Tshirts</a></li>
							<li><a role="tab" data-toggle="tab" ng-click="loadImages(currentSearch + ' funny saings')">Funny Sayings</a></li>
						</ul>			
					</div>		
					<div class="col-xs-9 list-group">
						<div ng-repeat="image in imagesData" >
							<div class="list-group-item col-xs-3" style="border: 0px; padding: 0px 5px;">
								<div class="text-center" ng-mouseenter="show = true" ng-mouseleave="show = false" style="border: 1px solid #dddddd; margin-bottom: 30px;">
									<a ng-click="openLightboxModal($index)" style="line-height: 150px;">
										<img ng-src="@{{image.thumbUrl}}" alt="">
	    							</a>
									<!--<a class="fancybox-buttons" data-fancybox-group="button"><img ng-src="@{{image.src}}" alt="" /></a>-->
									<!--<img class="media-imgs" style="max-height: 215px; object-fit: contain; overflow:hidden;" class="col-xs-12" ng-src="@{{image.src}}">-->
									<div ng-show="show" class="btn-group btn-group-justified col-xs-12" >
										<a ng-click="addToLibrary(image.thumbUrl, image.surl, 'image')" class="btn btn-primary" style="padding: 1px 12px;" role="button" title="Save"><i class="fa fa-save"></i></a>
										<a href="@{{image.surl}}" target="_blank" class="btn btn-default" style="padding: 1px 12px;" role="button"><i class="fa fa-external-link"></i></a>
									</div>
								</div>
							</div>
							<div ng-if="($index - 3) % 4 == 0 && $index != 0" class="clearfix col-xs-12" style="line-height: 5px;"><br/></div>
						</div>

						<div ng-show="imagesData == null" class="alert alert-dismissable alert-warning">
						  <button type="button" class="close" data-dismiss="alert">×</button>
						  <p>We could not retrieve any items for "@{{search}}"</p>
						</div>
						<a ng-show="imagesData != null" class="btn-block btn btn-info col-xs-12" ng-click="loadImagesMore()">Load More</a>
					</div>
				</div>
			</div>

			<div id="kwSkreened" class="tab-pane fade">
				<div class="col-xs-12 list-group">
					<div ng-repeat="item in skreenedData">
						<div class="list-group-item col-xs-4">
							<div class="row">
								<div class="col-xs-12">
									<img class="col-xs-12 thumbnail" ng-src="@{{item.thumb}}">
									<span>Title: @{{item.title}} </span>
									<span>Price: @{{item.price}} </span>
									<br/><br/>
									<div class="btn-group btn-group-justified">
										<a ng-click="addToLibrary(item.thumb, item.link, 'image')" class="btn btn-primary" role="button" title="Save"><i class="fa fa-save"></i></a>
										<a href="@{{item.link}}" target="_blank"class="btn btn-default"><i class="fa fa-external-link"></i> View</a>
									</div>
								</div>
							</div>
						</div>
						<div ng-if="($index - 2) % 3 == 0 && $index != 0" class="clearfix col-xs-12"><br/></div>
					</div>
					<div ng-show="skreenedData == null" class="alert alert-dismissable alert-warning">
					  <button type="button" class="close" data-dismiss="alert">×</button>
					  <p>We could not retrieve any items for "@{{search}}"</p>
					</div>
					<a ng-show="skreenedData != null" class="btn-block btn btn-info col-xs-12" ng-click="loadSkreenedMore()">Load More</a>
				</div>
			</div>

			<div id="kwCafepress" class="tab-pane fade">
				<div class="col-xs-12 list-group">
					<div ng-repeat="item in cafepressData">
						<div class="list-group-item col-xs-3">
							<div class="row">
								<div class="col-xs-12">
									<img class="col-xs-12 thumbnail" ng-src="@{{item.thumb}}">
									<span>Title: @{{item.title}} </span>
									<br/><br/>
									<div class="btn-group btn-group-justified">
										<a ng-click="addToLibrary(item.thumb, item.link, 'image')" class="btn btn-primary" role="button" title="Save"><i class="fa fa-save"></i></a>
										<a href="@{{item.link}}" target="_blank"class="btn btn-default"><i class="fa fa-external-link"></i> View</a>
									</div>
								</div>
							</div>
						</div>
						<div ng-if="($index - 3) % 4 == 0 && $index != 0" class="clearfix col-xs-12"><br/></div>
					</div>
					<div ng-show="cafepressData == null" class="alert alert-dismissable alert-warning">
					  <button type="button" class="close" data-dismiss="alert">×</button>
					  <p>We could not retrieve any items for "@{{search}}"</p>
					</div>
					<a ng-show="cafepressData != null" class="btn-block btn btn-info col-xs-12" ng-click="loadCafepressMore()">Load More</a>
				</div>
			</div>

			<div id="kwZazzle" class="tab-pane fade">
				<div class="col-xs-12 list-group">
					<div ng-repeat="item in zazzleData">
						<div class="list-group-item col-xs-4">
							<div class="row">
								<div class="col-xs-12">
									<img class="col-xs-12 thumbnail" ng-src="@{{item.thumb}}">
									<span>Title: @{{item.title}} </span>
									<span>Price: @{{item.price}} </span>
									<br/><br/>
									<div class="btn-group btn-group-justified">
										<a ng-click="addToLibrary(item.thumb, item.link, 'image')" class="btn btn-primary" role="button" title="Save"><i class="fa fa-save"></i></a>
										<a href="@{{item.link}}" target="_blank"class="btn btn-default"><i class="fa fa-external-link"></i> View</a>
									</div>
								</div>
							</div>
						</div>
						<div ng-if="($index - 2) % 3 == 0 && $index != 0" class="clearfix col-xs-12"><br/></div>
					</div>
					<div ng-show="zazzleData == null" class="alert alert-dismissable alert-warning">
					  <button type="button" class="close" data-dismiss="alert">×</button>
					  <p>We could not retrieve any items for "@{{search}}"</p>
					</div>
					<a ng-show="zazzleData != null" class="btn-block btn btn-info col-xs-12" ng-click="loadZazzleMore()">Load More</a>
				</div>
			</div>

			<div id="kwPinterest" class="tab-pane fade">
				<script type="text/javascript">
					$('#pinterestButton[data-toggle="tab"]').on('shown.bs.tab', function (e) {
						var pinterestUrl = $('#pinterestSearch').attr('href');
						if (pinterestUrl !== undefined)
						{
							window.open(pinterestUrl, '_blank');
						}
					});
				</script>
				<div class="row">
					<div class="col-xs-3">
						<ul class="nav nav-tabs nav-stacked" role="tablist">
							<li class="active"><a target="_blank" href="http://www.pinterest.com/search/pins/?q=@{{currentSearch}}" id="pinterestSearch" >@{{currentSearch}}</a></li>
							<li><a target="_blank" href="http://www.pinterest.com/search/pins/?q=@{{currentSearch}} funny images">Funny Images</a></li>
							<li><a target="_blank" href="http://www.pinterest.com/search/pins/?q=@{{currentSearch}} t-shirt designs">Tshirt Designs</a></li>
							<li><a target="_blank" href="http://www.pinterest.com/search/pins/?q=@{{currentSearch}} t-shirt and hoodies">Tshirt & Hoodies</a></li>
							<li><a target="_blank" href="http://www.pinterest.com/search/pins/?q=@{{currentSearch}} gift ideas">Gift Ideas</a></li>
							<li><a target="_blank" href="http://www.pinterest.com/search/pins/?q=@{{currentSearch}} quotes">Quotes</a></li>
							<li><a target="_blank" href="http://www.pinterest.com/search/pins/?q=@{{currentSearch}} sayings">Sayings</a></li>
							<li><a target="_blank" href="http://www.pinterest.com/search/pins/?q=@{{currentSearch}} womens tshirts">Womens Tshirts</a></li>
							<li><a target="_blank" href="http://www.pinterest.com/search/pins/?q=@{{currentSearch}} mens tshirts">Mens Tshirts</a></li>
							<li><a target="_blank" href="http://www.pinterest.com/search/pins/?q=@{{currentSearch}} jokes">Jokes</a></li>
							<li><a target="_blank" href="http://www.pinterest.com/search/pins/?q=@{{currentSearch}} t-shirt">Funny Tshirts</a></li>
							<li><a target="_blank" href="http://www.pinterest.com/search/pins/?q=@{{currentSearch}} funny saings">Funny Sayings</a></li>
						</ul>
					</div>
					<div class="col-xs-9 list-group">
					</div>
				</div>
			</div>	
			
		</div>

	</div>

</div>

@stop
