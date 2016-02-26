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

Route::get('piluku', function() {

	return View::make('piluku');

});

Route::get('test', function() {

	return Scraper::get("http://teespring.com/#q=walking%20dead&p=1");

});

Route::get('testresult', function() {

	$api_url = "http://api.myip.ms";
	$query = "calmtheham.com";
	$api_id = "id19626";
	$api_key = "1734538509-480566832-31064278";
	$timestamp = date('Y-m-d_h:i:s');

//$str = "http://api.myip.ms/cnn.com/api_id/id19626/api_key/1734538509-480566832-31064278/timestamp/2015-07-17_01:56:18";
//$url = "http://api.myip.ms/cnn.com/api_id/id19626/api_key/1734538509-480566832-31064278/signature/183bc2d4eee8144935f2cccba98e075c/timestamp/2015-07-17_01:56:18";
$str = $api_url."/".$query."/api_id/".$api_id."/api_key/".$api_key."/timestamp/".$timestamp;
$signature = md5($str);
$url = $api_url."/".$query."/api_id/".$api_id."/api_key/".$api_key."/signature/".$signature."/timestamp/".$timestamp;
echo "---------------------";


	echo "<pre>";

	$response = Scraper::get($url, "json");
	
            $rData["ip_address"] = $response["ip_address"];
            $rData["ip_range"] = $response["owners"]["owner"]["range"];
	
            
    

	var_dump($rData);

	//$response = Scraper::filterText("http://www.shopify.com/examples/fashion-and-clothing-templates", ".store-examples-item");

	//return AliExpress::search("yankees", 1);

	//return Google::searchImagesEx1("shopify", 0);

	//return Amazon::searchEx("yankees", 3);

	//return Zazzle::searchEx("yankees", 1);

});

// App::missing(function($exception)
// {
//     App::abort(404, 'Page not found');
//     //return Response::view('errors.missing', array(), 404);
// });