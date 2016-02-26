<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 * Frontend Routes
 */

Route::get('/', ['as' => 'home', 'before' => 'auth', function() {
	return Redirect::to('welcome');
}]);

Route::get('welcome', ['as' => 'welcome', 'before' => 'auth', function() {
	return View::make('index');
}]);

Route::any('zaxaa/ipn-delivery/654958217f77ee1031ea383164b376ca', 'IPNHandlerController@handle');

Route::resource('sessions', 	'SessionController', ['only' => ['create', 'store', 'destroy']]);

Route::get('login',  ['as' => 'login', 'uses' => 'SessionController@create']);
Route::get('logout', ['as' => 'logout', 'uses' => 'SessionController@destroy']);

Route::get('register', 'UserController@create');

Route::get('resend', ['as' => 'resendActivationForm', function()
{
	return View::make('users.resend');
}]);

Route::post('resend', 'UserController@resend');

Route::get('forgot', ['as' => 'forgotPasswordForm', function()
{
	return View::make('users.forgot');
}]);

Route::post('forgot', 'UserController@forgot');

Route::group(['prefix' => 'users'], function() {
	Route::get('{id}/activate/{code}', 	'UserController@activate')->where('id', '[0-9]+');
	Route::get('{id}/reset/{code}', 	'UserController@reset')->where('id', '[0-9]+');
	Route::get('getdata', 	'UserController@getdata');
});

Route::group(['before' => 'auth'], function() {

	Route::group(['prefix' => 'users'], function() {

		Route::post('{id}/change', 		'UserController@change');

		Route::get('{id}/suspend', 		['as' => 'suspendUserForm', function($id)
		{
			return View::make('users.suspend')->with('id', $id);
		}]);
		
		Route::post('{id}/suspend', 	'UserController@suspend')->where('id', '[0-9]+');
		Route::get('{id}/unsuspend', 	'UserController@unsuspend')->where('id', '[0-9]+');
		
		Route::get('{id}/ban',			'UserController@ban')->where('id', '[0-9]+');
		Route::get('{id}/unban', 		'UserController@unban')->where('id', '[0-9]+');

	});

	Route::resource('users', 'UserController');
	Route::resource('groups', 'GroupController');

	Route::resource('favorites', 	'FavoritesController');
	Route::resource('libraries', 	'LibrariesController');


	Route::group(['prefix' => 'api'], function() {

		Route::get('keyword/{query}', function($query) {
			return DuckDuckGo::instantSearch($query);
		});

		Route::get('trends/keywords', function() {
			return Trends::Keywords();
		});

		Route::get('trends/products', function() {
			return Trends::Products();
		});

		Route::get('trends/stats/{query}', function($query) {
			return GoogleTrends::getStats($query);
		});

		Route::get('articles/{query}', function($query) {
			return Trendspottr::search($query);
		});

		Route::get('amazon/{query}/{page?}', function($query, $page = 1) {
			//return Amazon::search($query, $page);
			return Amazon::searchEx($query, $page);
		});

		Route::get('ebay/{query}/{page?}', function($query, $page = 1) {
			//return Ebay::search($query, $page);
			return Ebay::searchEx($query, $page);
		});

		Route::get('ebay-watchcount/{query}/{category}/{sort}/{order}/{page?}', function($query, $category, $sort, $order, $page) {			
			return EbayWatchCount::searchEx($query, $category, $sort, $order,  $page);
		});

		Route::get('wanelo/{query}/{style}/{page?}', function($query, $style, $page = 1) {
			return Wanelo::searchEx($query, $style, $page);
		});
		
		Route::get('aliexpress/{query}/{page?}', function($query, $page = 1) {
			return AliExpress::search($query, $page);
		});

		Route::get('google/{query}/{offset?}', function($query, $offset = 0) {
			//return Google::searchImages($query, $offset);
			return Google::searchImagesEx($query, $offset);
		});

		Route::get('skreened/{query}/{page?}', function($query, $page = 1) {
			return Skreened::search($query, $page);
		});

		Route::get('cafepress/{query}/{page?}', function($query, $page = 1) {
			return Cafepress::search($query, $page);
		});

		Route::get('zazzle/{query}/{page?}', function($query, $page = 1) {
			return Zazzle::searchEx($query, $page);
		});

		Route::get('youtube/{query}/{token?}', function($query, $token = null) {
			$params = [
			    'q'             => $query,
			    'type'          => 'video',
			    'part'          => 'id, snippet',
			    'maxResults'    => 20,
			];
			return (
				new \Alaouy\Youtube\Youtube(Config::get('alaouy/youtube::KEY'))
			)->paginateResults($params, $token);
		});
		
		Route::get('favorites', function() {
			return Favorites::mine();
		});

		Route::get('library', function() {
			return Library::mine();
		});

		Route::get('shopify/category', function() {
			return Shopify::category();
		});

		Route::get('shopify/site/{title}/{query?}', function($title, $query = "") {
			return Shopify::site($title, $query);
		});

		Route::get('shopify/website', function() {
			return Websites::getAll();
		});

	});

	Route::get('shopify', ['as' => 'shopify', function()
	{
		return View::make('shopify');
	}]);

	Route::get('search', ['as' => 'search', function()
	{
		$trendData = [];

		return View::make('search', compact('trendData'));
	}]);

	Route::get('media', ['as' => 'media.search', function()
	{
		return View::make('media');
	}]);

	Route::get('products', ['as' => 'product.search', function()
	{
		return View::make('products');
	}]);

	Route::get('watchcount', ['as' => 'watchcount', function()
	{
		return View::make('watchcount');
	}]);

	Route::get('wanelo', ['as' => 'wanelo', function()
	{
		return View::make('wanelo');
	}]);

});

Route::get('top-trending', function() {

	return Redirect::to('search');
	
	$trends = Trends::Keywords();
	$trendCount = 0;
	$i = 0;
	while ($trendCount <= 5 && $trendCount < count($trends)) {
		if ( !isset($trends[$i]))
			continue;
		$keyword = $trends[$i];
		$keywordInfo = DuckDuckGo::instantSearch($keyword);

		if ( isset($keywordInfo["info"]["text"]) && $keywordInfo["info"]["text"] != "") {
			
			$articles = Trendspottr::search($keyword);

			if ( is_array($articles) && $articles["link_list"][0]["description"] != "" ) {

				$trendData[$trendCount]["info"] 	= $keywordInfo["info"];

				$trendData[$trendCount]["article"] 	= $articles["link_list"][0];

				$trendCount++;
			}

		}
		$i++;
	}

	return View::make('top', compact('trendData'));

});

Route::get('shopify/initIPRange', function() {

	IpRanges::create(array("range"	=> "23.227.32.0 - 23.227.63.255"));
	IpRanges::create(array("range"	=> "204.93.213.0 - 204.93.213.255"));
	echo "Done";

});

Route::get('shopify/scrapeIPRange', function() {

	return Shopify::scrapeIPRange();

});

Route::get('shopify/scrapeAllWebsite', function() {

	return Shopify::scrapeAllWebsite();

});

Route::get('shopify/collectWebsiteInfo', function() {

	return Shopify::collectWebsiteInfo();

});

Route::get('shopify/collectSite', function() {

	return Shopify::collectSite();

});

Route::get('testresult', function() {
	
	/*$data = [
		"category" => "test1",
		"site_address" => "test1",
		"ip_address" => "test1",
		"ip_range" => "test1"
	];

	ShopifySite::create($data);
die;*/

//http://dev.instanttrendsmachine.com/testresult
//http://dev.instanttrendsmachine.com/shopify/collectWebsite
//* * * * * root /etc/scrapewebsite > /var/log/branko.log 2>&1
//mysql --user=root --password=ZsRB4H1JjljncB4tDaz3

/*for ($i=0; $i<10; $i++) {
	// current time
echo date('h:i:s') . "\n";

echo '------------'.$i;

// sleep for 10 seconds
sleep(5);

// wake up !
echo date('h:i:s') . "\n";
}*/

die;

	$url = "http://myip.ms/browse/sites/41/ipID/23.227.32.0/ipIDii/23.227.63.255";
    $response = Scraper::filterText($url, "#sites_tbl tbody tr");

    if ($response == null)
    	echo 'aaaa';

    var_dump($response); die;

	/*Shopify::collectWebsiteInfo();
	die;*/

	//$url="http://api.similarweb.com/Site/Spigen.com/v2/tags?Format=JSON&UserKey=0023403a6a489bd1f86509032df5bc3f";
	$url ="http://api.similarweb.com/Site/Spigen.com/v1/orgsearch?start=6-2013&end=5-2014&md=true&Format=JSON&UserKey=0023403a6a489bd1f86509032df5bc3f";
	//$url ="http://api.similarweb.com/Site/Spigen.com/v1/paidsearch?start=6-2013&end=5-2014&md=true&Format=JSON&UserKey=0023403a6a489bd1f86509032df5bc3f";

	try {
		$response = Scraper::get($url, "json");

		$website_organic_keywords = "";
		
		foreach ($response["Data"] as $key => $row) {
			$website_organic_keywords .= $row["SearchTerm"].",";
		}

		echo $website_organic_keywords;

	var_dump($response);

					

	} catch (Exception $ex) {
		echo "aaa"; 
	} die;

});

// App::missing(function($exception)
// {
//     App::abort(404, 'Page not found');
//     //return Response::view('errors.missing', array(), 404);
// });