<div id="kwYoutube" class="tab-pane fade">
	<div class="row">
		<div class="col-xs-12">
			<div class="list-group">
				<div class="list-group-item" ng-repeat="video in youtubeData.results">
					<div class="row">
						<div class="col-xs-5">
							<a target="_blank" href="http://youtu.be/@{{video.id.videoId}}">
								<img class="col-xs-12" ng-src="@{{video.snippet.thumbnails.high.url}}">
							</a>
						</div>
						<div class="col-xs-7">
							<h4><a target="_blank" href="http://youtu.be/@{{video.id.videoId}}">@{{video.snippet.title}}</a></h4>
							<h5>Description:</h5>
							<p>@{{video.snippet.description}}</p>
							<h5>Date: @{{video.snippet.publishedAt | limitTo : 10}}</h5>
							<a ng-click="addToLibrary(video.snippet.thumbnails.high.url, 'http://youtu.be/' + video.id.videoId, 'video')" class="btn-block btn btn-info"><i class="fa fa-save"> Add to Library</i></a>
						</div>
					</div>
				</div>
				<a ng-if="youtubeData.info" class="btn-block btn btn-info" ng-click="setYoutubeToken(youtubeData.info)">Load More</a>
			</div>
		</div>
	</div>
</div>