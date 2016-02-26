<?php

class Cafepress {

	public static function search($query, $page = 1)
	{

		$query = str_replace(" ", "-", $query);

		/*$requestOne = Scraper::filterText("http://www.cafepress.com/+{$query}?page=" . $page, ".grid-unit");
		$requestTwo = Scraper::filterText("http://www.cafepress.com/+{$query}?page=" . $page + 1, ".grid-unit");

		return array_merge(self::parseItems($requestOne), self::parseItems($requestTwo));*/

		$request = Scraper::filterText("http://www.cafepress.com/+{$query}?page=" . $page, ".grid-unit");

		$data = self::parseItems($request);

		return $data;
	}
	
	private static function parseItems($response)
	{
		$data = array();

		foreach ($response as $key => $row) {

			$link 	= Scraper::getTagAttribute($row["raw"], 'a', 'href');
			$thumb 	= Scraper::getTagAttribute($row["raw"], "img", "src");
			$title	= Scraper::getTagAttribute($row["raw"], 'img', 'alt');

			$data[] = [
				"link"	=> $link,
				"thumb"	=> $thumb,
				"title"	=> ucwords($title),
			];
		}

		return $data;
	}
}