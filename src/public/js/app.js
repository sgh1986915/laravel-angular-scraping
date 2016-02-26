var app = angular.module('trendsApp', ['ui.bootstrap', 'bootstrapLightbox'])
.service('pendingRequests', function() {
  var pending = [];
  this.get = function() {
    return pending;
  };
  this.add = function(request) {
    pending.push(request);
  };
  this.remove = function(request) {
    pending = _.filter(pending, function(p) {
      return p.url !== request;
    });
  };
  this.cancelAll = function() {
    angular.forEach(pending, function(p) {
      p.canceller.resolve();
    });
  };
})
// This service wraps $http to make sure pending requests are tracked 
.service('httpService', ['$http', '$q', 'pendingRequests', function($http, $q, pendingRequests) {
  this.get = function(url) {
    var canceller = $q.defer();
    pendingRequests.add({
    	url: url,
    	canceller: canceller
    });
    //Request gets cancelled if the timeout-promise is resolved
    var requestPromise = $http.get(url, { timeout: canceller.promise });
    //Once a request has failed or succeeded, remove it from the pending list
    requestPromise.finally(function() {
    	pendingRequests.remove(url);
    });
    return requestPromise;
  }
}]);

// recent change for modal box
app.controller('ModalCtrl', function ($scope) {
    $scope.showModal = false;
    $scope.toggleModal = function(){
        $scope.showModal = !$scope.showModal;
    };
  });

// change module name here
app.directive('modal', function () {
    return {
      template: '<div class="modal fade">' + 
          '<div class="modal-dialog">' + 
            '<div class="modal-content">' + 
              '<div class="modal-header">' + 
                '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' + 
                '<h4 class="modal-title">{{ title }}</h4>' + 
              '</div>' + 
              '<div ng-transclude></div>' + 
            '</div>' + 
          '</div>' + 
        '</div>',
      restrict: 'E',
      transclude: true,
      replace:true,
      scope:true,
      link: function postLink(scope, element, attrs) {
        scope.title = attrs.title;


       // $(element).find('iframe').attr('src',temp);

        scope.$watch(attrs.visible, function(value){
          if(value == true)
            $(element).modal('show');
          else
            $(element).modal('hide');
        });

        $(element).on('shown.bs.modal', function(){
          scope.$apply(function(){
            scope.$parent[attrs.visible] = true;
          });

          var temp = $(element).attr('data-href');
          $(element).find('iframe').attr('src',temp);

        });

        $(element).on('hidden.bs.modal', function(){
          scope.$apply(function(){
            scope.$parent[attrs.visible] = false;
          });
        });
      }
    };
  });
// recent change for modal box


app.controller('keywordsController', ['$scope', '$http', 'httpService', 'pendingRequests', '$timeout', '$location', 'filterFilter', 'Lightbox', function ($scope, $http, httpService, pendingRequests, $timeout, $location, filterFilter, Lightbox) {

$scope.amazonPage = 1;
$scope.ebayPage = 1;
$scope.aliexpressPage = 1;
$scope.imagesData = [];

$scope.cancelAll = function() {
	pendingRequests.cancelAll();
}

$scope.initSearch = function() {

	$scope.currentSearch = $scope.search;

	$scope.currentPage = "trends";

	$scope.keywordData 	= null;
	$scope.youtubeToken = "";

	$scope.loadTrends();
	$scope.loadProducts();

	$scope.loadKeyword();
	$scope.searchYoutube();
	$scope.searchArticles();

	$scope.showTab();

}

$scope.initMedia = function() {

	$scope.currentSearch = $scope.search;

	$scope.currentPage = "media";

	$scope.youtubeToken = "";

	$scope.loadFavorites();

	$scope.searchImages();
	$scope.searchSkreened();
	$scope.searchCafepress();
	$scope.searchZazzle();

	$scope.showTab();

}

$scope.initProducts = function() {

	$scope.currentSearch = $scope.search;

	$scope.currentPage 	= "products";

	$scope.youtubeToken = "";

	$scope.loadFavorites();
	$scope.searchAmazon();
	$scope.searchEbay();
	$scope.searchAliExpress();

	$scope.showTab();

}

$scope.initLibrary = function() {

	$scope.refreshLibrary();
	$scope.loadFavorites();

	$scope.showTab();

}

$scope.refreshLibrary = function() {

	var url = "/api/library";

	var msg = Messenger().post({
		message: "Loading Library",
		id: "library"
	});

	httpService.get(url).success(function(data) {

		$scope.libraryData = data;
		msg.hide();

	}).error(function(data, status, headers, config) {
		if (data === null && status === 0) {
			// Cancelled
		}
		else {
			Messenger().post({
				message: "Failed To Load Library",
				type: "error",
				id: "library"
			});			
		}
	});
}

$scope.refreshSearch = function() {

	console.log("refresh");

	console.log($scope.currentPage);

	$scope.currentSearch = $scope.search;

	$scope.cancelAll();

	$scope.updateUrl();

	switch($scope.currentPage)
	{
		case "trends":
			$scope.refreshTrends();
			break;
		case "media":
			$scope.refreshMedia();
			break;
		case "products":
			$scope.refreshProducts();
			break;
	}

	$scope.showTab();

}

$scope.refreshTrends = function() {

	$('#chart_div').empty();

	$scope.cancelAll();

	$scope.updateUrl();

	$scope.keywordData 	= null;
	$scope.youtubeToken = "";

	$scope.loadKeyword();
	$scope.searchYoutube();
	$scope.searchArticles();

	$scope.loadGoogleTrends();

	$scope.showTab();
}

$scope.refreshMedia = function() {

	$scope.cancelAll();

	$scope.updateUrl();

	$scope.youtubeToken = "";

	$scope.searchImages();
	$scope.searchSkreened();
	$scope.searchCafepress();
	$scope.searchZazzle();

	$scope.showTab();

}

$scope.refreshProducts = function() {

	$scope.amazonPage = 1;
	$scope.ebayPage = 1;
	$scope.aliexpressPage = 1;
	
	$scope.cancelAll();

	$scope.updateUrl();

	$scope.searchAmazon();
	$scope.searchEbay();
	$scope.searchAliExpress();

	/**
	 * Tees
	 */
	/*
	$scope.searchZazzle();
	$scope.searchSkreened();
	$scope.searchCafepress();
	$scope.searchBustedtees();
	$scope.searchSnorgtees();
	$scope.searchTshirthell();
	$scope.searchTeespring();
	*/
	$scope.showTab();

}

$scope.loadGoogleTrends = function() {

	if ( !$scope.search )
		return false;

	google.setOnLoadCallback($scope.drawChart($scope.search));
}

$scope.drawChart = function(keyword) {
    var query = new google.visualization.Query('http://www.google.com/trends/fetchComponent?q=' + keyword + '&cid=TIMESERIES_GRAPH_0&export=3');
  	query.send($scope.handleQueryResponse);
}

$scope.handleQueryResponse = function(response) {
	var data = response.getDataTable();
  	var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
  	chart.draw(data, null);
}

$scope.loadKeyword = function() {

	if ( !$scope.search )
		return false;

	var url = "/api/keyword/" + $scope.search;

	var msg = Messenger().post({
		message: "Loading Keyword Data",
		id: "keywords"
	});

	httpService.get(url).success(function(data) {

		$scope.keywordData = data;

		$scope.showTab();

		msg.hide();

	}).error(function(data, status, headers, config) {
		if (data === null && status === 0) {
			// Cancelled
		}
		else {
			Messenger().post({
				message: "Failed To Load Keyword Data",
				type: "error",
				id: "keywords"
			});			
		}
	});

}

$scope.loadTrends = function() {

	var url = "/api/trends/keywords";

	var msg = Messenger().post({
		message: "Loading Keyword Trends Data",
		id: "trends-keywords"
	});

	httpService.get(url).success(function(data) {

		$scope.trendsData = data;
		msg.hide();
		
	}).error(function(data, status, headers, config) {
		if (data === null && status === 0) {
			// Cancelled
		}
		else {
			Messenger().post({
				message: "Failed To Load Keyword Trends Data",
				type: "error",
				id: "trends-keywords"
			});			
		}
	});
}

$scope.loadProducts = function() {

	var url = "/api/trends/products";
	
	var msg = Messenger().post({
		message: "Loading Products Trends Data",
		id: "trends-products"
	});

	httpService.get(url).success(function(data) {

		$scope.productsData = data;
		msg.hide();

	}).error(function(data, status, headers, config) {
		if (data === null && status === 0) {
			// Cancelled
		}
		else {
			Messenger().post({
				message: "Failed To Load Products Trends Data",
				type: "error",
				id: "trends-products"
			});			
		}
	});	
}

$scope.loadFavorites = function() {
	var url = "/api/favorites";

	var msg = Messenger().post({
		message: "Loading Favorites",
		id: "favorites"
	});

	httpService.get(url).success(function(data) {
		
		$scope.favoritesData = data;
		msg.hide();

	}).error(function(data, status, headers, config) {
		if (data === null && status === 0) {
			// Cancelled
		}
		else {
			Messenger().post({
				message: "Failed To Favorites",
				type: "error",
				id: "favorites"
			});			
		}
	});	
}

$scope.showTab = function() {
	$timeout(function() {
		$('#kwTabs a:first').tab('show');
	}, 500);
}

$scope.openLightboxModal = function (index) {
	Lightbox.openModal($scope.imagesData, index);
}

$scope.searchImages = function() {
	$scope.loadImages($scope.search);
}

$scope.loadImages = function(query) {
	$scope.imagesData = [];
	$scope.imageSearch = query;

	var msg = Messenger().post({
		message: "Loading Images",
		id: "images"
	});

	var url = "/api/google/" + query;

	httpService.get(url).success(function(data) {
		$scope.imagesData = data;

		msg.hide();
	}).error(function(data, status, headers, config) {
		if (data === null && status === 0) {
			// Cancelled
		}
		else {
			Messenger().post({
				message: "Failed To Load Images",
				type: "error",
				id: "images"
			});
		}

		$scope.imagesData = null;
	});
}

$scope.loadImagesMore = function() {

	if ( !$scope.imageSearch )
		return false;

	var msg = Messenger().post({
		message: "Loading Images",
		id: "images"
	});

	var offset = $scope.imagesData.length;

	var url 	= "/api/google/" + $scope.imageSearch + "/" + offset;

	httpService.get(url).success(function(data) {
		$scope.imagesData = $.merge($scope.imagesData, data);
		msg.hide();
	}).error(function(data, status, headers, config) {
		if (data === null && status === 0) {
			// Cancelled
		}
		else {
			Messenger().post({
				message: "Failed To Load Images",
				type: "error",
				id: "images"
			});			
		}
	});
}

$scope.searchSkreened = function() {

	if ( !$scope.search )
		return false;

	$scope.skreenedData = "";
	$scope.amazonData = null;

	var msg = Messenger().post({
		message: "Loading Skreened Products",
		id: "skreened-products"
	});

	var url = "/api/skreened/" + $scope.search;

	httpService.get(url).success(function(data) {

		$scope.skreenedData = data;
		msg.hide();

	}).error(function(data, status, headers, config) {
		if (data === null && status === 0) {
			// Cancelled
		}
		else {
			Messenger().post({
				message: "Failed To Load Skreened Products",
				type: "error",
				id: "skreened-products"
			});
		}

		$scope.skreenedData = null;
	});
}

$scope.loadSkreenedMore = function() {

	if ( !$scope.search )
		return false;

	var msg = Messenger().post({
		message: "Loading Skreened Products",
		id: "skreened-products"
	});

	var page = $scope.skreenedData.length / 21 + 1;

	var url 	= "/api/skreened/" + $scope.search + "/" + page;

	httpService.get(url).success(function(data) {
		$scope.skreenedData = $.merge($scope.skreenedData, data);
		msg.hide();
	}).error(function(data, status, headers, config) {
		if (data === null && status === 0) {
			// Cancelled
		}
		else {
			Messenger().post({
				message: "Failed To Load Skreened Products",
				type: "error",
				id: "skreened-products"
			});
		}
	});
}

$scope.searchCafepress = function() {

	if ( !$scope.search )
		return false;

	$scope.amazonData = null;
	$scope.cafepressData = "";

	var msg = Messenger().post({
		message: "Loading Cafepress Products",
		id: "cafepress-products"
	});

	var url = "/api/cafepress/" + $scope.search;

	httpService.get(url).success(function(data) {

		$scope.cafepressData = data;
		msg.hide();

	}).error(function(data, status, headers, config) {
		if (data === null && status === 0) {
			// Cancelled
		}
		else {
			Messenger().post({
				message: "Failed To Load Cafepress Products",
				type: "error",
				id: "cafepress-products"
			});
		}

		$scope.cafepressData = null;
	});
}

$scope.loadCafepressMore = function() {

	if ( !$scope.search )
		return false;

	var msg = Messenger().post({
		message: "Loading Cafepress Products",
		id: "cafepress-products"
	});

	var page = $scope.cafepressData.length / 28 + 1;

	var url = "/api/cafepress/" + $scope.search + "/" + page;

	httpService.get(url).success(function(data) {
		$scope.cafepressData = $.merge($scope.cafepressData, data);
		msg.hide();
	}).error(function(data, status, headers, config) {
		if (data === null && status === 0) {
			// Cancelled
		}
		else {
			Messenger().post({
				message: "Failed To Load Cafepress Products",
				type: "error",
				id: "cafepress-products"
			});
		}
	});
}

$scope.searchZazzle = function() {

	if ( !$scope.search )
		return false;

	var msg = Messenger().post({
		message: "Loading Zazzle Products",
		id: "zazzle-products"
	});

	var url = "/api/zazzle/" + $scope.search;

	httpService.get(url).success(function(data) {
		
		$scope.zazzleData = data;
		msg.hide();

	}).error(function(data, status, headers, config) {
		if (data === null && status === 0) {
			// Cancelled
		}
		else {
			Messenger().post({
				message: "Failed To Load Zazzle Products",
				type: "error",
				id: "zazzle-products"
			});
		}
	});
}

// load more zazzle scrapping
$scope.loadZazzleMore = function() {

	if ( !$scope.search )
		return false;

	var msg = Messenger().post({
		message: "Loading Zazzle Products",
		id: "zazzle-products"
	});

	var page = $scope.zazzleData.length / 60 + 1;

	var url = "/api/zazzle/" + $scope.search + "/" + page;

	httpService.get(url).success(function(data) {
		$scope.zazzleData = $.merge($scope.zazzleData, data);
		msg.hide();
	}).error(function(data, status, headers, config) {
		if (data === null && status === 0) {
			// Cancelled
		}
		else {
			Messenger().post({
				message: "Failed To Load Zazzle Products",
				type: "error",
				id: "zazzle-products"
			});
		}
	});
}

$scope.openAmazonLightboxModal = function (index) {
	Lightbox.openModal($scope.amazonData, index);
}

$scope.searchAmazon = function() {

	if ( !$scope.search )
		return false;

	$scope.amazonData = null;

	var msg = Messenger().post({
		message: "Loading Amazon Products",
		id: "amazon-products"
	});

	var url = "/api/amazon/" + $scope.search;

	httpService.get(url).success(function(data) {

		$scope.amazonData = data;
		msg.hide();

	}).error(function(data, status, headers, config) {
		if (data === null && status === 0) {
			// Cancelled
		}
		else {
			Messenger().post({
				message: "Failed To Load Amazon Products",
				type: "error",
				id: "amazon-products"
			});
		}
	});
}

$scope.loadAmazonMore = function() {

	if ( !$scope.search )
		return false;

	var msg = Messenger().post({
		message: "Loading Amazon Products",
		id: "amazon-products"
	});

	$scope.amazonPage++;
	
	var url = "/api/amazon/" + $scope.search + "/" + $scope.amazonPage;

	httpService.get(url).success(function(data) {
		//$scope.amazonData.Items.Item = $.merge($scope.amazonData.Items.Item, data.Items.Item);

		$scope.amazonData = $.merge($scope.amazonData, data);
		msg.hide();

	}).error(function(data, status, headers, config) {
		if (data === null && status === 0) {
			// Cancelled
		}
		else {
			Messenger().post({
				message: "Failed To Load Amazon Products",
				type: "error",
				id: "amazon-products"
			});
		}
	});
}

$scope.openAliExpressLightboxModal = function (index) {
	Lightbox.openModal($scope.aliexpressData, index);
}

$scope.searchAliExpress = function() {

	if ( !$scope.search )
		return false;

	$scope.aliexpressData = null;

	var msg = Messenger().post({
		message: "Loading AliExpress Products",
		id: "aliexpress-products"
	});

	var url = "/api/aliexpress/" + $scope.search;

	httpService.get(url).success(function(data) {

		$scope.aliexpressData = data;
		msg.hide();

	}).error(function(data, status, headers, config) {
		if (data === null && status === 0) {
			// Cancelled
		}
		else {
			Messenger().post({
				message: "Failed To Load AliExpress Products",
				type: "error",
				id: "aliexpress-products"
			});
		}
	});
}

$scope.loadAliExpressMore = function() {

	if ( !$scope.search )
		return false;

	var msg = Messenger().post({
		message: "Loading AliExpress Products",
		id: "aliexpress-products"
	});

	$scope.aliexpressPage++;
	
	var url = "/api/aliexpress/" + $scope.search + "/" + $scope.aliexpressPage;

	httpService.get(url).success(function(data) {
		
		$scope.aliexpressData = $.merge($scope.aliexpressData, data);
		msg.hide();

	}).error(function(data, status, headers, config) {
		if (data === null && status === 0) {
			// Cancelled
		}
		else {
			Messenger().post({
				message: "Failed To Load AliExpress Products",
				type: "error",
				id: "aliexpress-products"
			});
		}
	});
}

$scope.openEbayLightboxModal = function (index) {
	Lightbox.openModal($scope.ebayData, index);
}

$scope.searchEbay = function() {

	if ( !$scope.search )
		return false;

	$scope.ebayData = null;

	var msg = Messenger().post({
		message: "Loading Ebay Products",
		id: "ebay-products"
	});

	var url = "/api/ebay/" + $scope.search;

	httpService.get(url).success(function(data) {

		$scope.ebayData = data;
		msg.hide();

	}).error(function(data, status, headers, config) {
		if (data === null && status === 0) {
			// Cancelled
		}
		else {
			Messenger().post({
				message: "Failed To Load Ebay Products",
				type: "error",
				id: "ebay-products"
			});
		}
	});
}

$scope.loadEbayMore = function() {

	if ( !$scope.search )
		return false;

	var msg = Messenger().post({
		message: "Loading Ebay Products",
		id: "ebay-products"
	});

	$scope.ebayPage++;
	
	var url = "/api/ebay/" + $scope.search + "/" + $scope.ebayPage;

	httpService.get(url).success(function(data) {
		$scope.ebayData = $.merge($scope.ebayData, data);
		msg.hide();

	}).error(function(data, status, headers, config) {
		if (data === null && status === 0) {
			// Cancelled
		}
		else {
			Messenger().post({
				message: "Failed To Load Ebay Products",
				type: "error",
				id: "ebay-products"
			});
		}
	});
}

$scope.appendYoutube = function() {

	if ( !$scope.search )
		return false;

	var url = "/api/youtube/" + $scope.search + "/" + $scope.youtubeToken;

	var msg = Messenger().post({
		message: "Loading Youtube Videos",
		id: "youtube"
	});

	httpService.get(url).success(function(data) {
		
		$scope.youtubeData.results = $.merge($scope.youtubeData.results, data.results);
		
		$scope.youtubeData.info = data.info;

		msg.hide();

	}).error(function(data, status, headers, config) {
		if (data === null && status === 0) {
			// Cancelled
		}
		else {
			Messenger().post({
				message: "Failed To Load Youtube Videos",
				type: "error",
				id: "youtube"
			});			
		}
	});
}

$scope.searchYoutube = function() {
	
	if ( !$scope.search )
		return false;

	$scope.youtubeData = null;

	var url = "/api/youtube/" + $scope.search + "/" + $scope.youtubeToken;

	var msg = Messenger().post({
		message: "Loading Youtube Videos",
		id: "youtube"
	});

	httpService.get(url).success(function(data) {
		
		$scope.youtubeData = data;
		if ($scope.youtubeToken != ""){
			$scope.showTab();
		}
		msg.hide();

	}).error(function(data, status, headers, config) {	
		if (data === null && status === 0) {
			// Cancelled
		}
		else {
			Messenger().post({
				message: "Failed To Load Youtube Videos",
				type: "error",
				id: "youtube"
			});			
		}
	});
}

$scope.setYoutubeToken = function(token) {
	$scope.youtubeToken = token;
	$scope.appendYoutube();
}

$scope.searchArticles = function() {
	
	if ( !$scope.search )
		return false;

	$scope.articlesData = null;

	var msg = Messenger().post({
		message: "Loading Articles",
		id: "articles"
	});

	var url = "/api/articles/" + $scope.search;
	
	httpService.get(url).success(function(data) {

		$scope.articlesData = data;
		msg.hide();

	}).error(function(data, status, headers, config) {
		if (data === null && status === 0) {
			// Cancelled
		}
		else {
			Messenger().post({
				message: "Failed To Load Articles",
				type: "error",
				id: "articles"
			});			
		}
	});
}

$scope.clickAnalytics = function(keyword) {
	$scope.search = $scope.currentSearch = keyword;	
}

$scope.clickKeyword = function(keyword) {
	$scope.search = $scope.currentSearch = keyword;
	$scope.refreshTrends();
}

$scope.clickKeywordMedia = function(keyword) {
	$scope.search = $scope.currentSearch = keyword;
	$scope.refreshMedia();
}

$scope.clickKeywordProducts = function(keyword) {
	$scope.search = $scope.currentSearch = keyword;
	$scope.refreshProducts();
}

$scope.addToLibrary = function(thumbnail, src, type) {

	var url = "/libraries";

	$http.post(url, {thumbnail: thumbnail, src: src, type: type}).success(function(data) {
		var msg = Messenger().post({
			message: "Added To Library",
		});

	}).error(function(data, status, headers, config) {
		if (data === null && status === 0) {
			// Cancelled
		}
		else {
			Messenger().post({
				message: "Failed Adding To Library",
				type: "error",
				id: "favorites"
			});
		}
	});
}

$scope.deleteLibrary = function(itemId) {

	var url = "/libraries/" + itemId;

	$http.delete(url).success(function(data) {
		var msg = Messenger().post({
			message: "Deleted From Library",
			id: "library"
		});
		$scope.refreshLibrary();

	}).error(function(data, status, headers, config) {
		if (data === null && status === 0) {
			// Cancelled
		}
		else {
			Messenger().post({
				message: "Failed To Delete From Library",
				type: "error",
				id: "library"
			});			
		}
	});

}

$scope.clearSearch = function() {
	$scope.search = "";
	$scope.updateUrl();
}

$scope.addFavorite = function() {
	
	var url = "/favorites"

	if ( !$scope.search)
	{
		return false;
	}

	$http.post(url, {keyword: $scope.search}).success(function(data) {
		Messenger().post({
			message: "Added " + $scope.search + " To Favorites",
			id: "favorites"
		});
		if ( $scope.currentPage != "search" )
		{
			$scope.loadFavorites();
		}

	}).error(function(data, status, headers, config) {
		if (data === null && status === 0) {
			// Cancelled
		}
		else {
			Messenger().post({
				message: "Failed Add " + $scope.search + " To Favorites",
				type: "error",
				id: "favorites"
			});			
		}
	});
}

$scope.deleteFavorite = function(favoriteId) {
	if (!confirm("Are you sure want to remove this?")) return;
	
	var url = "/favorites/" + favoriteId;

	$http.delete(url).success(function(data) {
		Messenger().post({
			message: "Deleted Favorite",
			id: "favorites"
		});
		if ( $scope.currentPage != "search" )
		{
			$scope.loadFavorites();
		}

	}).error(function(data, status, headers, config) {
		if (data === null && status === 0) {
			// Cancelled
		}
		else {
			Messenger().post({
				message: "Failed To Delete Favorite",
				type: "error",
				id: "favorites"
			});			
		}
	});
}

$scope.updateUrl = function() {

	$timeout(function() {
		//console.log("url:" + $location.url());
		currentPage = $scope.search.replace(/ /g, '+');
		$location.path( currentPage );
    	$scope.$apply();
	}, 1);

}

$scope.decodeUrl = function() {
	path = $location.path();
	if (path) {
		pathArray = path.split("/");
		if (pathArray[1]) {
			$scope.search = pathArray[1].replace(/\+/g, ' ');
			$scope.currentPage = pathArray[1];
		}
	}
}

$scope.initUsers = function() {
	
	$scope.loadUsers();
}

$scope.loadUsers = function() {
	var url = "/users/getdata";

	httpService.get(url).success(function(data) {

		$scope.list = data;

	    //$scope.currentPageNum = 1; //current page
	    $scope.maxSize = 5; //pagination max size
	    $scope.entryLimit = 10; //max rows for data table

	    /* init pagination with $scope.list */
	    $scope.bigTotalItems = Math.ceil($scope.list.length/$scope.entryLimit);
	    $scope.bigCurrentPage = 1;
	    
	    $scope.$watch('searchText', function(term) {
	        // Create $scope.filtered and then calculat $scope.noOfPages, no racing!
	        $scope.filtered = filterFilter($scope.list, term);
	        $scope.bigTotalItems = Math.ceil($scope.filtered.length/$scope.entryLimit);
	    });

    }).error(function(data, status, headers, config) {
		
	});
}

$scope.deleteUser = function(userId) {
	if (!confirm("Are you sure want to remove this?")) return;
	
	var url = "/users/" + userId;

	$http.delete(url).success(function(data) {
		Messenger().post({
			message: "Deleted User",
			id: "users"
		});
		
		$scope.loadUsers();

	}).error(function(data, status, headers, config) {
		if (data === null && status === 0) {
			// Cancelled
		}
		else {
			Messenger().post({
				message: "Failed To Delete User",
				type: "error",
				id: "users"
			});
		}
	});
};

$scope.initShopify = function() {

	$scope.loadCategory();
	
}

$scope.loadCategory = function() {

	var url = "/api/shopify/category";

	var msg = Messenger().post({
		message: "Loading Shopify Category",
		id: "shopify-category"
	});

	httpService.get(url).success(function(data) {

		$scope.categoryData = data;
		msg.hide();
		
	}).error(function(data, status, headers, config) {
		if (data === null && status === 0) {
			// Cancelled
		}
		else {
			Messenger().post({
				message: "Failed To Load Shopify Category",
				type: "error",
				id: "shopify-category"
			});			
		}
	});
}

$scope.clickShopifyCategory = function(title, url) {
	
	var url = "/api/shopify/site/" + title + "/" + url;

	var msg = Messenger().post({
		message: "Loading Shopify Category Site",
		id: "shopify-category-site"
	});

	$scope.siteData = "";

	httpService.get(url).success(function(data) {

		console.log(data);
		
		$scope.siteData = data;
		msg.hide();
		
	}).error(function(data, status, headers, config) {
		if (data === null && status === 0) {
			// Cancelled
		}
		else {
			Messenger().post({
				message: "Failed To Load Shopify Category Site",
				type: "error",
				id: "shopify-category-site"
			});			
		}
	});

}


/**
 * Startup
 */
$scope.decodeUrl();

}]);

angular.module('trendsApp')
.filter('cleanText', function() {
	return function(input) {
		return jQuery("<div/>")
			.html(input)
			.text();
	}
});

app.filter('startFrom', function() {
    return function(input, start) {
        if(input) {
            start = +start; //parse to int
            return input.slice(start);
        }
        return [];
    }
});