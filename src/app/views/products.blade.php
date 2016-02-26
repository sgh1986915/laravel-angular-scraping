@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
- {{trans('pages.productsTitle')}}
@stop

{{-- Content --}}
@section('content')

@include('layouts.search_input')

<div class="row" ng-init="initProducts()">

	<div class="col-xs-2">		
		<div class="list-group">
			<span class="list-group-item">
				<h4 class="list-group-item-heading">Favorites</h4>
			</span>
			<a ng-repeat="favorite in favoritesData" ng-class="{ 'active' : search == favorite.keyword}" ng-click="clickKeywordProducts(favorite.keyword)" class="list-group-item">@{{favorite.keyword}}</a>
		</div>
	</div>

	<div ng-if="search" class="col-xs-10">
		
		<div ng-if="search" class="row">
			<div class="col-xs-12">
				<ul id="kwTabs" class="nav nav-tabs" role="tablist">
					<li><a data-target="#amazonProducts" role="tab" data-toggle="tab">Amazon</a></li>
					<li><a data-target="#ebayProducts" role="tab" data-toggle="tab">Ebay</a></li>
					<li><a data-target="#aliexpressProducts" role="tab" data-toggle="tab">AliExpress</a></li>
				</ul>			
			</div>			
		</div>

			
		<div class="tab-content">

			<div id="amazonProducts" class="tab-pane fade">

				<ul class="col-xs-12 list-group">
					<li class="list-group-item" ng-repeat="product in amazonData">
						<div class="row">
							<div class="col-xs-2">
								<a ng-click="openAmazonLightboxModal($index)">
									<img class="thumbnail col-xs-12" ng-src="@{{product.thumbUrl}}">
								</a>
							</div>
							<div class="col-xs-10">
								<h4><a target="_blank" href="@{{product.DetailPageURL}}">@{{product.Title}}</a></h4>
								
								<h5>Price: @{{product.Price}}</h5>

								<div ng-if="product.Content">
									<h5>Description:</h5>
									<h5>@{{product.Content | cleanText}}</h5>
								</div>
								<br/>
								<div class="btn-group btn-group-justified">
									
									<div ng-controller="ModalCtrl">
										<a ng-click="addToLibrary(product.url, product.DetailPageURL, 'product')" class="btn btn-primary" role="button" title="Save"><i class="fa fa-save"></i></a>

										<a class="btn btn-default btn-info" href="@{{product.DetailPageURL}}"><i class="fa fa-external-link"></i> View Item</a>

										<button ng-click="toggleModal()" class="btn btn-default"><i class="fa fa-eye"></i> Reviews</button>

										<modal title="Reviews" visible="showModal" data-href="@{{product.IFrameURL}}">
											<iframe src="" style="width: 100%;height: 100%;border: none;min-height: 500px;"></iframe>
										</modal>
									</div>
									<!-- <a ng-if="product.CustomerReviews.HasReviews" class="btn btn-default btn-default popup-box" href="@{{product.CustomerReviews.IFrameURL}}"><i class="fa fa-eye"></i> Reviews</a> -->
								</div>
							</div>
						</div>
					</li>

					<a class="btn-block btn btn-info col-xs-12" ng-click="loadAmazonMore()">Load More</a>
				</ul>
			</div>

			<div id="ebayProducts" class="tab-pane fade">

				<ul class="col-xs-12 list-group">
					<li class="list-group-item" ng-repeat="product in ebayData">
						<div class="row">
							<div class="col-xs-2">
								<a ng-click="openEbayLightboxModal($index)">
									<img class="thumbnail col-xs-12" ng-src="@{{product.thumbUrl}}">
								</a>
							</div>
							<div class="col-xs-10">
								<div class="pull-right">
									<a ng-click="addToLibrary(product.url, product.surl, 'product')" class="btn btn-primary btn-xs" role="button" title="Save"><i class="fa fa-save"></i></a>
									<a target="_blank" class="btn btn-default btn-info btn-xs" href="@{{product.surl}}"><i class="fa fa-external-link"></i></a>
								</div>

								<a target="_blank" href="@{{product.surl}}">
									<h4>@{{product.title}}</h4>
								</a>
								
								<h5>Price: <strong>@{{product.price}}</strong></h5>
							</div>
						</div>
					</li>

					<a class="btn-block btn btn-info col-xs-12" ng-click="loadEbayMore()">Load More</a>
				</ul>

			</div>

			<div id="aliexpressProducts" class="tab-pane fade">

				<ul class="col-xs-12 list-group">
					<li class="list-group-item" ng-repeat="product in aliexpressData">
						<div class="row">
							<div class="col-xs-2">
								<a ng-click="openAliExpressLightboxModal($index)">
									<img class="thumbnail col-xs-12" ng-src="@{{product.thumbUrl}}">
								</a>
							</div>
							<div class="col-xs-10">
								<div class="pull-right">
									<a ng-click="addToLibrary(product.thumbUrl, product.link, 'product')" class="btn btn-primary btn-xs" role="button" title="Save"><i class="fa fa-save"></i></a>
									<a target="_blank" class="btn btn-default btn-info btn-xs" href="@{{product.link}}"><i class="fa fa-external-link"></i></a>
								</div>

								<a target="_blank" href="@{{product.link}}">
									<h4>@{{product.title}}</h4>
								</a>
								
								<h5>Price: <strong>@{{product.price}}</strong></h5>
							</div>
						</div>
					</li>

					<a class="btn-block btn btn-info col-xs-12" ng-click="loadAliExpressMore()">Load More</a>
				</ul>
				
			</div>

		</div>

	</div>
</div>
@stop
