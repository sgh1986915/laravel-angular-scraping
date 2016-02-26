<?php

use GuzzleHttp\Client as Client;

class GoogleTrends {

	private static $trendsUrl = "http://hawttrends.appspot.com/api/terms/";

	public static function all() {
		
		return self::getTrends();

	}


	public static function worldwide()
	{
		return self::getIndex(1);
	}

	public static function usa()
	{
		return self::getIndex(1);
	}

	public static function getIndex($index)
	{

		$data = self::all();

		if ( isset($data[$index]) ) {
			return $data[$index];
		}
		return array();

	}

	private static function getTrends()
	{
		return Scraper::get(self::$trendsUrl, "json");
	}

	public static function getStats($keyword)
	{
		$url = "http://www.google.com/trends/fetchComponent?q={$keyword}&cid=TIMESERIES_GRAPH_0&export=3";

		return Scraper::get($url, "raw", false);
	}

}