<div class="row">
	<form action="" method="POST" role="form">
		<div class="col-xs-10 nopad-right">
			<div class="form-group">
				<input ng-model="search" ng-model-options="{ debounce: {'default': 500, 'blur': 0} } }" type="text" name="search" id="inputSearch" class="form-control input-lg" placeholder="Search...">
			</div>
		</div>
		<div class="col-xs-2 nopad-right">
			<div class="btn-group btn-group-justified">
				<a ng-click="refreshSearch()"	class="btn btn-lg btn-info" data-toggle="tooltip" title="Search"><i class="fa fa-search"></i></a>
				<a ng-click="addFavorite()" 	class="btn btn-lg btn-info" data-toggle="tooltip" title="Add to Favorites"><i class="fa fa-heart"></i></a>
				<a ng-click="clearSearch()" 	class="btn btn-lg btn-info" data-toggle="tooltip" title="Reset"><i class="fa fa-reply"></i></a>
			</div>
		</div>
	</form>
</div>