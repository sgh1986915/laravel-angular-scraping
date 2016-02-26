<?php

use GuzzleHttp\Client as Client;

class AlexaTrends {

	private static $url = "http://www.alexa.com/whatshot";

	public static function Topics() {
		
		$xpath 	= "#hottopics li";

		$results = Scraper::filterText(self::$url, $xpath);

		foreach ($results as $row) 
		{	
			$dom = new DOMDocument;

			$dom->loadHTML($row['raw']);
			
			foreach ($dom->getElementsByTagName('a') as $node) {
				$cleanResult = ucwords(trim($node->getAttribute('title')));
			}

			$cleanData[] = $cleanResult;
		}

		return $cleanData;
	}

	public static function Products()
	{
		
		$xpath 	= '#hoturls div ol li';

		$results = Scraper::filterText(self::$url, $xpath);


		if ( !is_array($results) )
			return array();

		array_splice($results, 10);
		
		foreach ($results as $row) 
		{	

			$href = Scraper::getAnchorHref($row['raw']);

			$href = str_replace("/whatshot?p=1&q=", null, $href);
			$href = ucwords(urldecode(trim($href)));

			$data[] = $href;
		}

		return $data;
	}

	public static function Pages()
	{

		$xpath 	= '#hoturls div ol li div.listing';

		$results = Scraper::filterText(self::$url, $xpath);


		if ( !is_array($results) )
			return array();
		
		return $results;

		foreach ($results as $row) 
		{	
			$dom = new DOMDocument;

			$dom->loadHTML($row['raw']);
			
			foreach ($dom->getElementsByTagName('a') as $node) {
				$cleanResult = $node->getAttribute('href');
				$cleanResult = str_replace("/whatshot?p=1&q=", null, $cleanResult);
				$cleanResult = ucwords(urldecode(trim($cleanResult)));

			}

			$cleanData[] = $cleanResult;
		}

		return $cleanData;
	}

}