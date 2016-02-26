<?php

class Shopify {
	
	public static function category()
	{
		$response = Scraper::filterText("http://www.shopify.com/examples", ".examples-grid-nav__item");

		return self::parseItems($response);
	}

	public static function site($categoryName, $query)
	{
		$response = Scraper::filterText("http://www.shopify.com/examples/".$query, ".store-examples-item");

		foreach ($response as $key => $row) {

			$title = Scraper::filterText($row, ".store-examples-item__title", false)[0]["text"];
			$url = Scraper::getTagAttributeEx($row["raw"], "a", "href", 1);

			$address = trim(ucwords(Scraper::filterText($row["raw"], ".store-examples-item__url", false)[0]["text"]));
			$ip_info = self::getIPInfo($address);

			$data = [
				"category"	=> $categoryName,
				"website_address"	=> $address,
				"ip_address"	=> $ip_info["ip_address"],
				"ip_range"	=> $ip_info["ip_range"],
				"url"	=> $url,
				"title"	=> $title,
			];

			self::storeShopifyExample($data);

			$list[] = $data;

		}

		return $list;
	}
	
	private static function parseItems($response)
	{
		foreach ($response as $key => $row) {

			$url 	= Scraper::getTagAttribute($row["raw"], 'a', 'href');
			
			$data[] = [
				"title"	=> $row["text"],
				"url"	=> strlen($url) < 10 ? "" : substr($url, 10)
			];

		}

		return $data;
	}

	private static function storeShopifyExample($data)
	{
		$validator = Validator::make($data, ShopifyExample::$rules);

		if ($validator->fails())
		{
			return $validator->messages()->toJson();
		}

		return ShopifyExample::create($data);
	}

	private static function getIPInfo($address)
	{
		$api_url = "http://api.myip.ms";
		$query = $address;
		$api_id = "id19626";
		$api_key = "1734538509-480566832-31064278";
		$timestamp = date('Y-m-d_h:i:s');

		$str = $api_url."/".$query."/api_id/".$api_id."/api_key/".$api_key."/timestamp/".$timestamp;
		$signature = md5($str);
		$url = $api_url."/".$query."/api_id/".$api_id."/api_key/".$api_key."/signature/".$signature."/timestamp/".$timestamp;

		$response = Scraper::get($url, "json");

        $rData["ip_address"] = $response["ip_address"];
        $rData["ip_range"] = $response["owners"]["owner"]["range"];

		return $rData;			
	}

}
