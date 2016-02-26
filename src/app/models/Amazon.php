<?php

use ApaiIO\Configuration\GenericConfiguration as AmazonConfiguration;
use ApaiIO\Operations\Search;
use ApaiIO\ApaiIO;

class Amazon {

	private static function apiInit()
	{
		$conf = new AmazonConfiguration();

		$conf
		    ->setCountry('com')
		    ->setAccessKey("AKIAIF6UCBJ22HQZJ4MA")
		    ->setSecretKey("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")
		    ->setAssociateTag("jgilgarcia-20");

		$apaiIO = new ApaiIO($conf);

		return $apaiIO;
	}

	public static function search($query, $page = 1)
	{
		$api = self::apiInit();

		$search = new Search();

		$search->setCategory('All');
		$search->setResponseGroup(array('Medium', 'Reviews'));
		$search->setKeywords($query);
		$search->setPage($page);

		$formattedResponse = $api->runOperation($search);

		return json_decode(json_encode(simplexml_load_string($formattedResponse)), true);
	}

	public static function searchEx($query, $page = 1)
	{
		$api = self::apiInit();

		$search = new Search();

		$search->setCategory('All');
		$search->setResponseGroup(array('Medium', 'Reviews'));
		$search->setKeywords($query);
		$search->setPage($page);

		$formattedResponse = $api->runOperation($search);

		$json = json_decode(json_encode(simplexml_load_string($formattedResponse)), true);

		foreach ($json["Items"]["Item"] as $key => $row) {

			if (isset($row["LargeImage"]["URL"])) {
				$data[$key]["url"] = $row["LargeImage"]["URL"];
			}
			if (isset($row["MediumImage"]["URL"])) {
				$data[$key]["thumbUrl"] = $row["MediumImage"]["URL"];
			}
			$data[$key]["DetailPageURL"] = $row["DetailPageURL"];
			$data[$key]["Title"] = $row["ItemAttributes"]["Title"];
			if (isset($row["ItemAttributes"]["ListPrice"])) {
				$data[$key]["Price"] = $row["ItemAttributes"]["ListPrice"]["FormattedPrice"];
			}
			if (isset($row["EditorialReviews"]["EditorialReview"]["Content"])) {
				$data[$key]["Content"] = $row["EditorialReviews"]["EditorialReview"]["Content"];
			}
			if (isset($row["CustomerReviews"]["IFrameURL"])) {
				$data[$key]["IFrameURL"] = $row["CustomerReviews"]["IFrameURL"];
			}

		}

		return $data;
	}

	public static function bestSellers($category = "all")
	{
		switch ($category) {
			case 'all':
				$products = self::getAllBestSellers();
				break;
			
			default:
				$products = self::getAllBestSellers();
				break;
		}

		return $products;
	}

	private static function getAllBestSellers()
	{
		$url = "http://www.amazon.com/Best-Sellers/zgbs";

		$titles = Scraper::filterText($url, ".zg_homeWidgetItem .zg_itemInfo .zg_title");

		$images = Scraper::filterText($url, ".zg_homeWidgetItem .zg_image a");

		foreach ($titles as $key => $title) {

			$imageSrc = Scraper::getImageSource($images[$key]["raw"]);
			
			$data[$key]["title"] 	= trim($title["text"]);

			$data[$key]["src"]		= $imageSrc;
		}

		return $data;
	}

}