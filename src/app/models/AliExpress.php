<?php

class AliExpress {

	public static function search($query, $page)
	{
		$url = "http://www.aliexpress.com/wholesale?SearchText={$query}&catId=0&page={$page}";

		$response = Scraper::filterText($url, "li.list-item");

		$data = self::parseItems($response);

		return $data;
	}

	private static function parseItems($response)
	{
		foreach ($response as $key => $row) {

			$thumb = null;

			$rawImageLoader = Scraper::filterText($row["raw"], ".img a", false);

			$rawImageLoader = $rawImageLoader[0]["raw"];
			
			if ( strpos($rawImageLoader, " src=") )
			{
				$thumb = Scraper::getTagAttribute($row["raw"], "img", "src");
			}
			elseif ( strpos($rawImageLoader, "image-src=") ) {
				$thumb = Scraper::getTagAttribute($row["raw"], "img", "image-src");
			}

			$link 	= Scraper::getAnchorHref($row["raw"]);
			//$thumb 	= Scraper::getTagAttribute($row["raw"], "img", "src");

			$title	= Scraper::filterText($row["raw"], ".detail h3 a.product", false);

			$rPrice	= Scraper::filterText($row["raw"], ".price", false);

			$price = trim(ucwords($rPrice[0]["text"]));

			$data[] = [
				"link"	=> $link,
				"url"	=> self::searchLargeImage($link),
				"thumbUrl"	=> $thumb,
				"title"	=> ucwords($title[0]["text"]),
				"price"	=> $price,
			];

		}

		return $data;
	}

	public static function searchLargeImage($url)
	{
		$response = Scraper::filterText($url, ".ui-image-viewer");

		foreach ($response as $key => $row) {
            return Scraper::getTagAttribute($row["raw"], "img", "src");
        }
	}
}