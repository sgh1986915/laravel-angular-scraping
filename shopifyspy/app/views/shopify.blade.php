@extends('layouts.piluku')

{{-- Web site Title --}}
@section('title')
@parent
 - {{trans('pages.searchTitle')}}
@stop

{{-- Content --}}
@section('content')

<div class="manage_buttons">
	<div class="row">
		<div class="col-md-3 search">
			<form action="#" method="post">
				<input ng-model="searchText" type="text" name="search" class="form-control" placeholder="Search Website">
			</form>
		</div>
	</div>
</div>

<div class="row" ng-init="initShopify()">
	<div class="col-md-12 nopad-right">
		<!-- panel -->
		<div class="panel panel-piluku panel-users">
			<div class="panel-heading">
				<h3 class="panel-title">
					Shopify Websites:
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
			</div>
			<div class="panel-body nopadding">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<th>Web Site</th>
							<th>Traffic Volume</th>
							<th>Global Rank</th>
							<th>Global Traffic</th>
							<th>Best Sellers</th>
							<th>Traffic Stats</th>
						</thead>
						<tbody>
							<tr ng-repeat="data in filtered | startFrom:(bigCurrentPage-1)*entryLimit | limitTo:entryLimit" class="table-row">
								<td><a ng-href="http://@{{data.website}}" target="_blank">@{{data.website}}</a></td>
								<td>@{{data.traffic_volume}}</td>
								<td>@{{data.global_rank}}</td>
								<td>@{{data.global_traffic}}</td>
							  	<td>
							  		<a href="#" ng-click="openWebLightboxModal('@{{data.best_seller}}')">View Best Sellers
							  			<i class="icon ti-blackboard"></i></a>
							  	</td>
							  	<td>
							  		<a href="#" ng-click="openWebLightboxModal('@{{data.traffic_stats}}')" class="btn btn-green">
							  			<i class="icon ti-eye"></i></a>
							  	</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- /panel -->
	</div>
</div>

<div class="row">
	<div class="col-md-12 nopad-right">
		<pagination total-items="bigTotalItems" ng-model="bigCurrentPage" max-size="maxSize" ng-click="setCurrent(bigCurrentPage)" 
			class="pagination-sm pull-right" boundary-links="true" rotate="false" num-pages="numPages"></pagination>
	</div>
</div>

@stop
