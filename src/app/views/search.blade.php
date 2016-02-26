@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
 - {{trans('pages.searchTitle')}}
@stop

{{-- Content --}}
@section('content')

@include('layouts.search_input')

<div class="row" ng-init="initSearch()">

	<div class="col-xs-4">
		<ul class="nav nav-tabs" role="tablist">
		  <li ng-if="trendsData" class="active"><a data-target="#keywords" role="tab" data-toggle="tab">Keywords</a></li>
		  <li ng-if="productsData"><a data-target="#products" role="tab" data-toggle="tab">Products</a></li>
		</ul>

		<div class="tab-content">
			<div ng-if="trendsData" class="list-group tab-pane fade in active" id="keywords">
				<a ng-repeat="keyword in trendsData" class="list-group-item" ng-class="{'active' : search == keyword}" ng-click="clickKeyword(keyword)">@{{keyword}}</a>
			</div>

			<div class="list-group tab-pane fade" id="products">
				<a ng-repeat="keyword in productsData" class="list-group-item" ng-class="{'active' : search == keyword}" ng-click="clickKeyword(keyword)">@{{keyword}}</a>
			</div>
		</div>
	</div>
	
	<div class="col-xs-8" ng-if="search == null">
		@foreach ($trendData as $row)

		<div class="row well well-sm">
			<div class="row">
				<div class="col-xs-12">
					<a href="{{URL::to('search')}}#/{{str_replace(" ", "+", $row["info"]["heading"])}}" ng-click="clickKeyword('{{$row["info"]["heading"]}}')"><h2>{{$row["info"]["heading"]}}</h2></a>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-9">
					<p>{{$row["article"]["title"]}}</p>
					<p>{{$row["info"]["text"]}}</p>
					<p>{{$row["article"]["description"]}}</p>
					<p><a target="_blank" href="{{$row["article"]["url"]}}">Full Story Here</a></p>
				</div>
				<div class="col-xs-3">
					<img class="col-xs-12" src="{{$row["article"]["thumbnail_url"]}}" />
				</div>
			</div>
		</div>

		@endforeach
	</div>

	<div class="col-xs-8" ng-if="search">

		<div id="chart_div"></div>

		<div class="row">
			<div class="col-xs-12">
				<ul class="nav nav-tabs" role="tablist" id="kwTabs">
					<li ng-if="keywordData.info.text"><a data-target="#kwInfo" role="tab" data-toggle="tab">Info</a></li>
					<li ng-if="youtubeData.results.length >=1"><a data-target="#kwYoutube" role="tab" data-toggle="tab">Youtube</a></li>
					<li ng-if="articlesData.link_list.length >=1"><a data-target="#kwArticles" role="tab" data-toggle="tab">Articles</a></li>
				</ul>
			</div>
		</div>

		<div class="tab-content">

			<div id="kwInfo" class="tab-pane fade">
				<div class="row">
					<div class="col-xs-12">
						<div ng-if="keywordData.info.text">
							<div class="thumbnail clearfix">
								<div class="caption col-xs-9">
									<p>@{{keywordData.info.text}}</p>
									<a class="btn btn-sm btn-block btn-info" target="_blank" ng-href="@{{keywordData.info.infoURL}}">@{{keywordData.info.infoSource}}</a>
									<p ng-repeat="result in keywordData.info.results">
										<a class="btn btn-sm btn-block btn-info" target="_blank" ng-href="@{{result.url}}">@{{result.type}}</a>
									</p>
								</div>
								<div ng-if="keywordData.info.image" class="well text-center col-xs-3">
									<img class="col-xs-12" ng-src="@{{keywordData.info.image}}">
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>

			<div id="kwTopics" class="tab-pane fade">
				<div class="row">
					<div class="col-xs-12">

						<div ng-if="keywordData.topics.length >= 1" class="list-group keywordsRelated">
							
							<a class="list-group-item" ng-repeat="topic in keywordData.topics" ng-click="clickKeyword(topic.relation)">
								<!--<img ng-if="topic.image" style="height:100px;" ng-src="@{{topic.image}}">-->
								<div class="row">
									<div class="col-xs-10">
										<span class="col-xs-12">
											@{{topic.relation}} - @{{topic.text}}
										</span>
									</div>
									<div class="col-xs-2">
										<span class="col-xs-12 badge pull-right">@{{topic.tag}}</span>
									</div>
								</div>
							</a>
							
						</div>

					</div>
				</div>
			</div>

			@include('partials.youtube')

			<div id="kwArticles" class="tab-pane fade">
				<div class="row">
					<div class="col-xs-12">
						<div class="list-group">
							<div class="list-group-item" ng-repeat="article in articlesData.link_list">
								<div class="row">
									<div class="col-xs-1">
										<span>@{{article.trending_score}}</span>
									</div>
									<div class="col-xs-9">
										<a target="_blank" href="@{{article.url}}">@{{article.provider_url}}</a>
										<br/>
										<span>@{{article.title}}</span>
										<span>@{{article.description}}</span>
										<span>@{{article.provider_url}}</span>
										<span>@{{article.provider_url}}</span>
									</div>
									<div class="col-xs-2">
										<div class="text-center" ng-mouseenter="show = true" ng-mouseleave="show = false">
											<div class="row">
												<div class="col-xs-12">
													<img class="col-xs-12" ng-src="@{{article.thumbnail_url}}">
													<div ng-show="show" class="btn-group btn-group-justified col-xs-12">
														<a ng-click="addToLibrary(article.thumbnail_url, article.url, 'article')" class="btn btn-primary" role="button" title="Save"><i class="fa fa-save"></i></a>
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
			</div>

		</div>
	</div>
</div>

@stop
