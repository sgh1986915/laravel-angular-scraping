<?php

class Skreened {

	public static function search($query, $page = 1)
	{
		$response = Scraper::filterText("http://skreened.com/search/{$query}?page=$page", ".gallery-item");

		$data = self::parseItems($response);

		return $data;
	}
	
	private static function parseItems($response)
	{
		foreach ($response as $key => $row) {

			$link 	= Scraper::getAnchorHref($row["raw"]);
			$thumb 	= Scraper::getTagAttribute($row["raw"], "img", "data-src");
			$title	= Scraper::getTagAttribute($row["raw"], "img", "alt");
			$rPrice	= Scraper::filterText($row["raw"], ".caption-price", false);
			$price = trim(ucwords($rPrice[0]["text"]));

			$data[] = [
				"link"	=> $link,
				"thumb"	=> $thumb,
				"title"	=> ucwords($title),
				"price"	=> $price,
			];
		}

		return $data;
	}
}