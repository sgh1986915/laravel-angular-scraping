@extends('layouts.piluku')

{{-- Web site Title --}}
@section('title')
@parent
 - {{trans('pages.mediaTitle')}}
@stop

{{-- Content --}}
@section('content')

@include('layouts.search_input')

<div class="row">
	<form class="form form-horizontal">
		
		<div class="col-xs-3 nopad-right">
			<div class="form-group">
				<label class="col-sm-3 control-label">Category:</label>
				<div class="col-sm-9">
					<select class="form-control input-sm ng-pristine ng-valid ng-touched" ng-model="category" id="category" ng-options="item.name for item in categories track by item.id">
						<option value="">None</option>
					</select>
				</div>
			</div>
		</div>

		<div class="col-xs-3 nopad-right">
			<div class="form-group">
				<label class="col-sm-3 control-label">Sort:</label>
				<div class="col-sm-9">
					<select class="form-control input-sm ng-pristine ng-valid ng-touched" ng-model="sort" id="sort" ng-options="item.name for item in sorts track by item.id">					
						<option value="">None</option>
					</select>
				</div>
			</div>
		</div>

		<div class="col-xs-3 nopad-right">
			<div class="form-group">
				<label class="col-sm-3 control-label">Order:</label>
				<div class="col-sm-9">
					<select class="form-control input-sm ng-pristine ng-valid ng-touched" ng-model="order" id="order" ng-options="item.name for item in orders track by item.id">						
						<option value="">None</option>
					</select>
				</div>
			</div>
		</div>


	</form>


</div>
<br>

<div class="row" ng-init="initEbayWatchCount()" ng-show="sDone">

	<!-- <div class="col-xs-2">		
		<div class="list-group">
			<span class="list-group-item">
				<h4 class="list-group-item-heading">Search</h4>
			</span>

			<a class="list-group-item" href="./" title="Home Page / Most Watched eBay Items: Basic Search" target="_top">Most Watched: Basic</a>
			<a class="list-group-item" href="./advanced.php" title="Most Watched eBay Items: Advanced Search" target="_top">Most Watched: Advanced</a>
			<a class="list-group-item" href="./bids.php" title="eBay Auction Items With the Most Bids" target="_top">Most Bids</a>
			<a class="list-group-item" href="./searches.php" title="Most Popular eBay Searches (like eBay Pulse)" target="_top">Top eBay Searches</a>
			<a class="list-group-item" href="./bids.php?zero" title="eBay Auctions/Items Ending Soon With No Bids" target="_top">No Bids, Ending Soon</a>
			<a class="list-group-item" href="./bh.php" title="eBay Buyer/Bidder History Search Tool" target="_top">Buyer/Bidder History Search</a>
			<a class="list-group-item" href="./ebay-daily-deal.php" title="Today Only: eBay Daily Deal" target="_top">eBay Daily Deal</a>
			<a class="list-group-item" href="./misspelled.php" title="Find Misspelled eBay Items and Auctions" target="_top">Misspelled eBay Items</a>
			<a class="list-group-item" href="./faq.php#ilu" title="eBay Item Lookup" target="_top" rel="nofollow">eBay Item Lookup</a>
			<a class="list-group-item" href="./ebay-search.php" title="eBay Classic/Wildcard Search Tool" target="_top">Wildcards/Classic Search</a>
			<a class="list-group-item" href="./search-provider.php" title="WatchCount.com Browser Search Bar/Box Provider" target="_top">Browser Search Bar/Box</a>
			<a class="list-group-item" href="./ie-accelerator.php" title="WatchCount.com IE Accelerator" target="_top">IE Accelerator</a>

		</div>
	</div> -->

	<div class="col-xs-2 nopad-right">		
		<div class="list-group">
			<span class="list-group-item">
				<h4 class="list-group-item-heading">Favorites</h4>
			</span>
			<a ng-repeat="favorite in favoritesData" ng-class="{ 'active' : search == favorite.keyword}" ng-click="clickEbayWatchCount(favorite.keyword)" class="list-group-item">@{{favorite.keyword}}</a>
		</div>
	</div>

	<!-- <div ng-if="search" class="col-xs-10"> -->
	<div class="col-xs-10">
		<div class="panel panel-piluku">		
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-12">	
						<h3>Most Watched/Popular on eBay Right Now</h3>
					</div>
				</div>

				<div role="tabpanel">
					<!-- Nav tabs -->
					<!-- <ul class="nav nav-tabs piluku-tabs" role="tablist">

						<li role="presentation" class="active"><a href="#ebayResults" aria-controls="ebayResults" role="tab" data-toggle="tab">eBay</a></li>
						
					</ul> -->

					<!-- Tab panes -->
					<div class="tab-content piluku-tab-content">

						<!-- IMAGES TAB -->
						<div role="tabpanel" class="tab-pane active" id="ebayResults">
							<div class="row">
							
								<!-- <div class="col-xs-3">
									<div class="list-group demo-list-group">			
										<a class="list-group-item" value="0">(no category selected)</a>
										<a class="list-group-item" value="20081">Antiques</a>
										<a class="list-group-item" value="550">Art</a>
										<a class="list-group-item" value="2984">Baby</a>
										<a class="list-group-item" value="267">Books</a>
										<a class="list-group-item" value="12576">Business, Industrial</a>
										<a class="list-group-item" value="625">Cameras, Photo</a>
										<a class="list-group-item" value="11450">Clothing, Shoes, Accessories</a>
										<a class="list-group-item" value="11116">Coins, Currency</a>
										<a class="list-group-item" value="1">Collectables</a>
										<a class="list-group-item" value="58058">Computers, Tablets</a>
										<a class="list-group-item" value="293">Consumer Electronics</a>
										<a class="list-group-item" value="14339">Crafts</a>
										<a class="list-group-item" value="11232">DVD, Movies</a>
										<a class="list-group-item" value="45100">Entertainment Memorabilia</a>
										<a class="list-group-item" value="26395">Health, Beauty</a>
										<a class="list-group-item" value="11700">Home, Garden</a>
										<a class="list-group-item" value="281">Jewellery, Watches</a>
										<a class="list-group-item" value="15032">Mobile Phones, Accessories</a>
										<a class="list-group-item" value="11233">Music</a>
										<a class="list-group-item" value="173484">Musical Instruments</a>
										<a class="list-group-item" value="870">Pottery, Glass</a>
										<a class="list-group-item" value="10542">Real Estate</a>
										<a class="list-group-item" value="382">Sporting Goods</a>
										<a class="list-group-item" value="64482">Sporting Memorabilia</a>
										<a class="list-group-item" value="260">Stamps</a>
										<a class="list-group-item" value="220">Toys, Hobbies</a>
										<a class="list-group-item" value="9800">Vehicles</a>
										<a class="list-group-item" value="6028">Vehicle Parts, Accessories</a>
										<a class="list-group-item" value="1249">Video Games</a>
										<a class="list-group-item" value="172008">Deal Vouchers, Gift Cards</a>
										<a class="list-group-item" value="99">Everything Else</a>
									</div>											
								</div> -->	
								
								<div class="col-xs-12 list-group">

									
									<div id="ebayWatchCountData">
										<ul class="col-xs-12 list-group">
											<li class="list-group-item" ng-repeat="watchItem in ebayWatchCountData" style="margin-left: 15px;">
												<div class="row">
													<div class="col-xs-3">
														<a ng-click="openEbayWatchCountLightboxModal($index)" style="line-height: 150px;max-height:160px;max-width:160px;">
															<img ng-src="@{{ watchItem.thumbUrl[0] }}" alt="" class="imag">
						    							</a>
													</div>
													<div class="col-xs-9">	
														<div class="pull-right">
															<h4><span class="label label-info"> Past sales:  @{{ watchItem.pastSales[0] }}</span></h4>
														</div>			
														
														<!-- <h5>Watch count: <strong>@{{ watchItem.watchCount[0] }}</strong></h5>	 -->
														<h4><span class="label label-warning"> Watch count:  @{{ watchItem.watchCount[0] }}</span></h4>
														
														<a target="_blank" href="@{{ watchItem.viewItemURL[0] }}">
															<h4>@{{ watchItem.caption[0] }}</h4>
														</a>
														
														<h5>Current Bid/Price: <strong>$@{{ watchItem.price[0] }}</strong></h5>
														<h5>Time left: <strong>@{{ watchItem.timeLeft }}</strong></h5>
														<div class="pull-right">
															<a ng-click="addToLibrary(watchItem.thumbUrl[0], watchItem.viewItemURL[0], 'watchcount')" class="btn btn-primary btn-xs" role="button" title="Save"><i class="fa fa-save"></i></a>
															<a target="_blank" class="btn btn-default btn-info btn-xs" href="@{{watchItem.viewItemURL[0]}}"><i class="fa fa-external-link"></i></a>
														</div>	
													</div>
												</div>
											</li>
											<!-- <a class="btn-block btn btn-info col-xs-12" ng-click="loadEbayWatchCountMore()">Load More</a> -->
										</ul>
										<a style="margin-left: 8px;" ng-show="ebayWatchCountData != null" class="btn-block btn btn-info col-xs-12" ng-click="loadEbayWatchCountMore()">Load More</a>
									</div>
									<!-- // <script src="http://svcs.ebay.com/services/search/FindingService/v1?SECURITY-APPNAME=mvc06473a-def8-429b-a064-1e9397b0232&OPERATION-NAME=findItemsByKeywords&SERVICE-VERSION=1.0.0&RESPONSE-DATA-FORMAT=JSON&callback=_cb_findItemsByKeywords&REST-PAYLOAD&keywords=iphone%203g&paginationInput.entriesPerPage=3"></script> -->

									<div ng-show="ebayWatchCountData == null" class="alert alert-dismissable alert-warning">
									  <button type="button" class="close" data-dismiss="alert">×</button>
									  <p>We could not retrieve any items for "@{{search}}"</p>
									</div>
									
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