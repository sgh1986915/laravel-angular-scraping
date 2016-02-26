@extends('layouts.piluku')

{{-- Web site Title --}}
@section('title')
@parent
 - {{trans('pages.mediaTitle')}}
@stop

{{-- Content --}}
@section('content')

<!-- @include('layouts.search_input') -->

<style type="text/css">
	
	.dataTables_paginate {

        margin-top: 20px;

        text-align: center !important;

    }

    .dataTables_info {

        text-align: center !important;

    }

    a.paginate_button {

        background-color: #f2f4f7;

    }

    a.paginate_active { 

        color: white;

        background-color: #5bc0de;

    }

    a.paginate_button, a.paginate_active { 

        border: 1 solid #ddd;

        margin: 1px;

        padding: 5px 10px;

        cursor: pointer;

    }

    #results-table_length{
    	margin-bottom: -30px;
    }
</style>

<div class="row" ng-init="initWanelo()">

	<!-- <div ng-if="search" class="col-xs-10"> -->
	<div class="col-xs-12 nopad-right">
		<div class="panel panel-piluku">	
			<div class="panel-heading">
                <h3 class="panel-title">
                    Search
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
			<div class="panel-body">
				
				<form ng-submit="searchWanelo()" class="form ng-pristine ng-invalid ng-invalid-required">
		            <div class="row">
		                <div class="col-md-5">
		                    <!--Default Form-->
		                    <div class="form-group">
		                        <label class="control-label">Enter query:</label>
		                        <input ng-model="search" ng-model-options="{ debounce: {'default': 500, 'blur': 0} } }" type="text" name="search" id="inputSearch" class="form-control input-lg ng-pristine ng-valid" placeholder="Search...">
		                        <!-- <input required="" type="text" ng-model="q" name="query" class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched" placeholder="Query"> -->
		                    </div>
		                </div>
		                <div class="col-md-5">
		                    <div class="form-group">
		                        <label class="control-label">Category:</label>
		                        <select class="form-control ng-pristine ng-valid ng-touched" ng-model="category" ng-options="cat.name for cat in categories track by cat.id">
		                        	<option value="" class="">All</option>
		                        	<!-- <option value="active">Active</option>
		                        	<option value="bohemian">Bohemian &amp; Rustic</option>
		                        	<option value="classic">Classic</option>
		                        	<option value="fantasy">Fantasy</option>
		                        	<option value="high_fashion_couture">High Fashion</option>
		                        	<option value="minimalist">Minimalist</option>
		                        	<option value="soft_grunge">Soft Grunge</option>
		                        	<option value="surf_skate">Surf &amp; Skate</option>
		                        	<option value="trendy">Trendy</option>
		                        	<option value="urban">Urban</option>
		                        	<option value="vintage_retro">Vintage &amp; Retro</option> -->
		                        </select>
		                    </div>
		                </div>
		                <div class="col-md-1 col-lg-1">
		                    <div class="form-group">
		                        <label class="hidden-xs hidden-sm control-label" style="width: 100%;"></label>
		                        <button ng-click="refreshSearch()" ng-model="waneloBtn" class="btn btn-primary btn-lg ng-binding" style=" margin-top: 4px;" id="waneloBtn">Search</button>
		                        <!-- <a ng-click="refreshSearch()" class="btn btn-lg btn-info" data-toggle="tooltip" title="Search"><i class="fa fa-search"></i></a> -->
		                    </div>
		                </div>
		            </div>
		        </form>

			</div>
		</div>
	</div>

	<div ng-show="sDone" class="col-xs-12 nopad-right">
		<div class="panel panel-piluku">	
			<div class="panel-heading">
                <h3 class="panel-title">
                    Results
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
			<div class="panel-body">
				
					<!-- <table id="datatatable"> -->
					<div class="table-responsive2">
						<table class="table table-hover table-striped display" id="results-table">
							<thead>
								<tr>
									<th width="10%">&nbsp;</th>
									<th width="40%">Name</th>
									<th class="text-center" width="25%">Price</th>
									<th class="text-center" width="25%">Save Count</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>						
					</div>
					<div class="row text-center" style="margin-top: 20px;margin-bottom: 20px;">
	                    <a class="btn btn-sm btn-info" ng-click="updateWaneloPage(-1)" title="Previous set"><<</a>
	                    <a class="btn btn-sm btn-info" ng-click="updateWaneloPage(1)" title="Next set">>></a>
	                </div>
			</div>
		</div>
	</div>


	








</div>



@stop