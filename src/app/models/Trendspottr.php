<?php

class Trendspottr {

	public static function search($query) 
	{
		$url = "http://trendspottr.com/indexStream.php?q=".$query;
		return Scraper::get($url, "json");
	}
}