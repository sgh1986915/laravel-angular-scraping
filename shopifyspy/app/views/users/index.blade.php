@extends('layouts.piluku')

{{-- Web site Title --}}
@section('title')
@parent
{{trans('pages.listwith')}} {{trans('pages.users')}}
@stop

{{-- Content --}}
@section('content')
<div class="manage_buttons">
	<div class="row">
		<div class="col-md-3 search">
			<form action="#" method="post">
				<input ng-model="searchText" type="text" name="search" class="form-control" placeholder="Search User">
			</form>
		</div>
		<div class="col-md-9">
			<div class="buttons-list">
				<div class="pull-right-btn">
					<a href="{{ route('users.create') }}" class="btn btn-primary pull-right">{{ trans('users.createUser') }}</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row" ng-init="initUsers()">
	<div class="col-md-12">
		<!-- panel -->
		<div class="panel panel-piluku panel-users">
			<div class="panel-heading">
				<h3 class="panel-title">
					{{trans('pages.currentusers')}}:
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
							<th>{{trans('pages.user')}}</th>
							<th>{{trans('pages.status')}}</th>
							<th>{{trans('pages.options')}}</th>
						</thead>
						<tbody>
							<tr ng-repeat="data in filtered | startFrom:(bigCurrentPage-1)*entryLimit | limitTo:entryLimit" class="table-row">
								<td><a ng-href="/users/@{{data.id}}">@{{data.email}}</a></td>
							  	<td ng-if="data.status == 'Active'">{{trans('pages.active')}}</td>
							    <td ng-if="data.status != 'Active'">{{trans('pages.notactive')}}</td>
							    <td>
							    	<a ng-href="/users/@{{data.id}}/edit" class="btn btn-xs btn-green"></i>{{trans('pages.actionedit')}}</a> 
							    	<a ng-href="/users/@{{data.id}}/suspend" ng-show="data.status != 'Suspended'" class="btn btn-xs btn-orange">{{trans('pages.actionsuspend')}}</a> 
							    	<a ng-href="/users/@{{data.id}}/unsuspend" ng-show="data.status == 'Suspended'" class="btn btn-xs btn-orange">{{trans('pages.actionunsuspend')}}</a> 
							    	<a ng-href="/users/@{{data.id}}/ban" ng-show="data.status != 'Banned'" class="btn btn-xs btn-gray">{{trans('pages.actionban')}}</a> 
							    	<a ng-href="/users/@{{data.id}}/unban" ng-show="data.status == 'Banned'" class="btn btn-xs btn-gray">{{trans('pages.actionunban')}}</a> 
							    	<a href="#" ng-click="deleteUser(data.id)" class="btn btn-xs btn-red">{{trans('pages.actiondelete')}}</a>
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
	<div class="col-md-12">
		<pagination total-items="bigTotalItems" ng-model="bigCurrentPage" max-size="maxSize" 
			class="pagination-sm pull-right" boundary-links="true" rotate="false" num-pages="numPages"></pagination>
	</div>
</div>
@stop