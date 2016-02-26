<?php

class Zazzle {
	public static function search($query, $page = 1)
	{
		$response = Scraper::filterText("http://www.zazzle.com/{$query}+mens+tshirts?pg=$page", ".aIrL-324 .aIrL-main");

		$data = self::parseItems($response);

		return $data;
	}

	private static function parseItems($response)
	{
		foreach ($response as $key => $row) {

			$link 	= Scraper::getTagAttribute($row["raw"], 'a', 'href');
			$thumb 	= Scraper::getTagAttribute($row["raw"], "img", "src");
			$title	= Scraper::getTagAttribute($row["raw"], "img", "alt");
			$rPrice	= Scraper::filterText($row["raw"], ".u7fO-price", false);
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

	public static function searchEx($query, $page = 1)
	{
		$response = Scraper::filterText("http://www.zazzle.com/{$query}+mens+tshirts?pg=$page", ".ZazzleCollectionItemCell");

		if ($response == null)
			return null;

		$data = self::parseItemsEx($response);

		return $data;
	}
	
	private static function parseItemsEx($response)
	{
		foreach ($response as $key => $row) {

			$rowData = $row["raw"];

			if ($rowData != null) {
				$link 	= Scraper::getTagAttribute($rowData, 'a', 'href');
				$thumb 	= Scraper::getTagAttribute($rowData, "img", "src");
				$title	= Scraper::getTagAttribute($rowData, "img", "alt");
				$price	= Scraper::filterText($rowData, ".ZazzleCollectionItemCellProduct-price", false)[0]["text"];

				$data[] = [
					"link"	=> $link,
					"thumb"	=> $thumb,
					"title"	=> ucwords($title),
					"price"	=> $price,
				];
			}
		}

		return $data;
	}
}