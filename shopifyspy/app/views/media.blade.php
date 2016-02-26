@extends('layouts.piluku')

{{-- Web site Title --}}
@section('title')
@parent
 - {{trans('pages.mediaTitle')}}
@stop

{{-- Content --}}
@section('content')

@include('layouts.search_input')


<div class="row" ng-init="initMedia()">

	<div class="col-xs-2 nopad-right">		
		<div class="list-group">
			<span class="list-group-item">
				<h4 class="list-group-item-heading">Favorites</h4>
			</span>
			<a ng-repeat="favorite in favoritesData" ng-class="{ 'active' : search == favorite.keyword }" ng-click="clickKeywordMedia(favorite.keyword)" class="list-group-item">
			@{{favorite.keyword}}
			</a>
		</div>
	</div>

	<div ng-if="search" class="col-xs-10 nopad-right">
		<div class="panel panel-piluku">
			<!-- <div class="panel-heading">
				<h3 class="panel-title">
					Tabs Left with Border
					<span class="panel-options">
						<a href="#" class="panel-refresh">
							<i class="icon ti-reload"></i>
						</a>
						<a href="#" class="panel-minimize">
							<i class="icon ti-angle-up"></i>
						</a>
						<a href="#" class="panel-close">
							<i class="icon ti-close"></i>
						</a>
					</span>
				</h3>
			</div> -->
			<div class="panel-body">
				<div role="tabpanel">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs piluku-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#kwImages" aria-controls="kwImages" role="tab" data-toggle="tab">Images</a></li>
						<li role="presentation"><a href="#kwSkreened" aria-controls="kwSkreened" role="tab" data-toggle="tab">Skreened</a></li>
						<li role="presentation"><a href="#kwCafepress" aria-controls="kwCafepress" role="tab" data-toggle="tab">Cafepress</a></li>
						<li role="presentation"><a href="#kwZazzle" aria-controls="kwZazzle" role="tab" data-toggle="tab">Zazzle</a></li>
						<li role="presentation"><a href="#kwPinterest" aria-controls="kwPinterest" role="tab" data-toggle="tab" id="pinterestButton">Pinterest</a></li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content piluku-tab-content">

						<!-- IMAGES TAB -->
						<div role="tabpanel" class="tab-pane active" id="kwImages">
							<div class="row">
								<div class="col-xs-3">
									<div class="list-group demo-list-group">										
										<a class="list-group-item active" ng-click="loadImages(search)">@{{currentSearch}}</a>										
										<a class="list-group-item" ng-click="loadImages(currentSearch + ' funny images')">Funny Images</a>
										<a class="list-group-item" ng-click="loadImages(currentSearch + ' t-shirt designs')">Tshirt Designs</a>
										<a class="list-group-item" ng-click="loadImages(currentSearch + ' t-shirt and hoodies')">Tshirt & Hoodies</a>
										<a class="list-group-item" ng-click="loadImages(currentSearch + ' gift ideas')">Gift Ideas</a>
										<a class="list-group-item" ng-click="loadImages(currentSearch + ' quotes')">Quotes</a>
										<a class="list-group-item" ng-click="loadImages(currentSearch + ' sayings')">Sayings</a>
										<a class="list-group-item" ng-click="loadImages(currentSearch + ' womens tshirts')">Womens Tshirts</a>
										<a class="list-group-item" ng-click="loadImages(currentSearch + ' mens tshirts')">Mens Tshirts</a>
										<a class="list-group-item" ng-click="loadImages(currentSearch + ' jokes')">Jokes</a>
										<a class="list-group-item" ng-click="loadImages('funny ' + currentSearch + ' t-shirt')">Funny Tshirts</a>
										<a class="list-group-item" ng-click="loadImages(currentSearch + ' funny saings')">Funny Sayings</a>
									</div>											
								</div>		
								<div class="col-xs-9 list-group">

									<div ng-repeat="image in imagesData" >
										<div class="list-group-item col-xs-3 imgContainer" style="border: 0px; padding: 0px 5px;">
											<div class="text-center" ng-mouseenter="show = true" ng-mouseleave="show = false" style="border: 1px solid #dddddd; margin-bottom: 30px;">
												<a ng-click="openLightboxModal($index)" style="line-height: 150px;">
													<img ng-src="@{{image.thumbUrl}}" alt="" class="imag">
				    							</a>
												
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
						
						<!-- SKREENED TAB -->
						<div role="tabpanel" class="tab-pane" id="kwSkreened">
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

						<!-- CAFEPRESS -->
						<div role="tabpanel" class="tab-pane" id="kwCafepress">
							<div class="col-xs-12 list-group">
								<div ng-repeat="item in cafepressData">
									<div class="list-group-item col-xs-3">
										<div class="row">
											<div class="col-xs-12" style="min-height:303px;">
												<img class="col-xs-12 thumbnail" ng-src="@{{item.thumb}}">
												<div style="min-height:269px;">Title: @{{item.title}} </div>
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

						<!-- ZAZZLE -->
						<div role="tabpanel" class="tab-pane" id="kwZazzle">
							<div class="col-xs-12 list-group">
								<div ng-repeat="item in zazzleData">
									<div class="list-group-item col-xs-4">
										<div class="row">
											<div class="col-xs-12">
												<img class="col-xs-12 thumbnail" ng-src="@{{item.thumb}}">
												<div style="height:337px;">Title: @{{item.title}} </div>
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

						<!-- PINTEREST -->
						<div role="tabpanel" class="tab-pane" id="kwPinterest">
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
		</div>
	</div>


</div>

@stop
