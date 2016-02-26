@extends('layouts.piluku')

{{-- Web site Title --}}
@section('title')
@parent
{{trans('pages.helloworld')}}
@stop

{{-- Content --}}
@section('content')

<div class="row" ng-init="initLibrary()">
	<div class="col-md-12">
		<div class="panel panel-piluku">
			<div class="panel-body">
				<div role="tabpanel">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs piluku-tabs piluku-noborder" role="tablist">
						<li role="presentation" class="active"><a href="#" data-target="#kwMedia" aria-controls="kwMedia" role="tab" data-toggle="tab">Media</a></li>
						<li role="presentation"><a href="#" data-target="#kwFavorites" aria-controls="kwFavorites" role="tab" data-toggle="tab">Favorites</a></li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content piluku-tab-content">
						<div role="tabpanel" class="tab-pane active" id="kwMedia">
	                        <div class="col-xs-12">
	                            <div class="demo" id="gallery">
	                            	<div ng-repeat="item in libraryData" class="list-inline list-unstyled">
										<div class="col-xs-3 thumbnail" ng-mouseenter="show = true" ng-mouseleave="show = false">
											<a target="_blank" href="@{{item.src}}">
												<img class="col-xs-12" ng-src="@{{item.thumbnail}}" title="@{{item.type}}">
											</a>
											<div ng-show="show" class="btn-group btn-group-justified col-xs-12">
												<a ng-click="deleteLibrary(item.id)" class="btn btn-danger" role="button"><i class="fa fa-trash"></i></a>
												<a href="@{{item.src}}" target="_blank" class="btn btn-default" role="button"><i class="fa fa-external-link"></i></a>
											</div>
										</div>
										<div ng-if="($index - 3) % 4 == 0 && $index != 0" class="clearfix col-xs-12"><br/></div>
									</div>
	                            </div>
	                        </div>
						</div>
						<div role="tabpanel" class="tab-pane" id="kwFavorites">
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<th>Keyword</th>
										<th>{{trans('pages.options')}}</th>
									</thead>
									<tbody>
										<tr ng-repeat="favorite in favoritesData" class="table-row">
											<td>@{{favorite.keyword}}</td>
										  	<td>
										    	<a ng-click="deleteFavorite(favorite.id)" class="btn btn-red">
										    		<i class="ion ion-ios-trash-outline"></i></a>
										    </td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@stop

@section('otherScript')
<script src="{{ asset('piluku-html/assets/js/gallery/jquery.sliphover.min.js') }}"></script>
<script src="{{ asset('piluku-html/assets/js/gallery/freewall.js') }}"></script>
<script src="{{ asset('piluku-html/assets/js/gallery.js') }}"></script>
@stop