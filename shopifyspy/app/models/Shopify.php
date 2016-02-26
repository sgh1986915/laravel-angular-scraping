<?php

class Shopify {

	private static function getIPRange()
	{
		return IpRanges::getAll();
	}

	public static function scrapeAllWebsite()
	{
		$ip_ranges = self::getIPRange();

		foreach ($ip_ranges as $key => $value) {
			$range = $value["range"];

			$ips = explode(" - ", $range);

			$from_ip = $ips[0];
			$to_ip = $ips[1];

			self::scrapeWebsite($from_ip, $to_ip);
		}
	}

	private static function scrapeWebsite($from_ip, $to_ip)
	{
		echo "<pre>";

		$page = 1;

		while(true) {

			try {
				$url = "http://myip.ms/browse/sites/".$page."/ipID/".$from_ip."/ipIDii/".$to_ip;
			    $response = Scraper::filterText($url, "#sites_tbl tbody tr");

			    if ($response == null) {
			    	echo $url."--null<br>";
					$page++;
					return;
				} else {
					
					$i = 1;

					foreach ($response as $key => $row) {
						if ($i % 2 == 1) {
							$website = trim(ucwords(Scraper::filterText($row["raw"], ".row_name", false)[0]["text"]));
							$location = trim(ucwords(Scraper::filterText($row["raw"], "td", false)[4]["text"]));
							$popular_rating = trim(ucwords(Scraper::filterText($row["raw"], "td", false)[6]["text"]));

							$data = [
								"website" => $website,
								"location" => $location,
								"popular_rating" => $popular_rating
							];

							self::storeWebsite($data);
						}

						$i++;
					}

					sleep(5);

				}

			} catch (RequestException $ex) {
	            error_log("CURL exception: " . $ex);
	        }

			$page++;
		}

		return "well done";
	}

	private static function storeWebsite($data)
	{
		$validator = Validator::make($data, Websites::$rules);

		if ($validator->fails())
		{
			return $validator->messages()->toJson();
		}

		if (Websites::checkWebsite($data) > 0) return;

		return Websites::create($data);
	}

	public static function collectWebsiteInfo()
	{
		$websites = Websites::all();

		foreach ($websites as $key => $row) {

			self::storeWebsiteInfo($row);

		}
	}

	private static function storeWebsiteInfo($row)
	{
		$id = $row["id"];
		
		// IF NOT DUPLICATE WEBSITE
		if (Websites::checkWebsiteInfo($id)) {

			// IF THIS FAILS WE DO NOT CONTINUE
			$traffic_volume = self::getTrafficVolume($row["website"]);
			if($traffic_volume==null){
				//DONT DO NOTHING CAUSE THE REST WILL FAIL
				return;	
			}
			else
			{
				// TRAFFIC VOLUME IS FOUND GOOD!
				// DO THE REST
				$rank_reach = self::getRankReach($row["website"]);
				$data = [
					"id" => $row["id"],
					"traffic_volume" => $traffic_volume,
					"global_rank" => is_null($rank_reach) ? null : $rank_reach[0],
					"global_traffic" => is_null($rank_reach) ? null : $rank_reach[1],
				];
				
				$website = Websites::findOrFail($id);
			    $website->update($data);
				
				// NOW DO KEYWORD TAGGING
				self::storeWebsiteDetails($row);
				
			}

		}
		return;
	}

	private static function storeWebsiteDetails($row)
	{
		$id = $row["id"];

		if (WebsiteDetails::count() > 0 && WebsiteDetails::checkWebsiteDetails($id) > 0) return;

		$website_tags = self::getWebsiteTags($row["website"]);
		$website_organic_keywords = self::getWebsiteOrgKeywords($row["website"]);
		$website_paid_keywords = self::getWebsitePaidKeywords($row["website"]);

		$data = [
			"website_id" => $row["id"],
			"website_tags" => $website_tags,
			"website_organic_keywords" => $website_organic_keywords,
			"website_paid_keywords" => $website_paid_keywords,
		];

		WebsiteDetails::create($data);

		return;
	}

	private static function getTrafficVolume($website)
	{
		$start = date('m-Y', strtotime("-2 month"));
		$end = date('m-Y', strtotime("-2 month"));
		$api_url = Config::get('api.similarweb.api_url');
		$api_key = Config::get('api.similarweb.api_key');

		$url = $api_url."/".$website."/v1/visits?gr=Monthly&start=".$start."&end=".$end."&md=false&Format=JSON&UserKey=".$api_key;

		try {
			
			$response = Scraper::get($url, "json");
			
			if (!empty($response["Values"])) {
				$latest = sizeof($response["Values"]) - 1;
				
				return $response["Values"][$latest]["Value"];
			}

		} catch (Exception $ex) {
			/*echo "<pre>";
			var_dump("error - ".$url);
			continue;*/

			return null;
		}

		return null;
	}

	private static function getRankReach($website)
	{
		$api_url = Config::get('api.similarweb.api_url');
		$api_key = Config::get('api.similarweb.api_key');

		$url = $api_url."/".$website."/v1/traffic?Format=JSON&UserKey=".$api_key;

		try {
			
			$response = Scraper::get($url, "json");

			$result = [$response["GlobalRank"], $response["TrafficShares"][0]["SourceValue"]];
				
			return $result;

		} catch (Exception $ex) {
			return null;
		}

		return null;
	}

	private static function getWebsiteTags($website)
	{
		$api_url = Config::get('api.similarweb.api_url');
		$api_key = Config::get('api.similarweb.api_key');

		$url = $api_url."/".$website."/v2/tags?Format=JSON&UserKey=".$api_key;

		try {

			$response = Scraper::get($url, "json");

			$website_tags = "";
			
			foreach ($response["Tags"] as $key => $row) {
				$website_tags .= $row["Name"].",";
			}
				
			return $website_tags;

		} catch (Exception $ex) {
			return null;
		}

		return null;
	}

	private static function getWebsiteOrgKeywords($website)
	{
		$start = date('m-Y', strtotime("-2 month"));
		$end = date('m-Y', strtotime("-2 month"));

		$api_url = Config::get('api.similarweb.api_url');
		$api_key = Config::get('api.similarweb.api_key');

		$url = $api_url."/".$website."/v1/orgsearch?start=".$start."&end=".$end."&md=true&Format=JSON&UserKey=".$api_key;

		try {

			$response = Scraper::get($url, "json");

			$website_organic_keywords = "";
			
			foreach ($response["Data"] as $key => $row) {
				$website_organic_keywords .= $row["SearchTerm"].",";
			}

			return $website_organic_keywords;

		} catch (Exception $ex) {
			return null;
		}

		return null;
	}

	private static function getWebsitePaidKeywords($website)
	{
		$start = date('m-Y', strtotime("-2 month"));
		$end = date('m-Y', strtotime("-2 month"));

		$api_url = Config::get('api.similarweb.api_url');
		$api_key = Config::get('api.similarweb.api_key');

		$url = $api_url."/".$website."/v1/paidsearch?start=".$start."&end=".$end."&md=true&Format=JSON&UserKey=".$api_key;

		try {

			$response = Scraper::get($url, "json");

			$website_paid_keywords = "";
			
			foreach ($response["Data"] as $key => $row) {
				$website_paid_keywords .= $row["SearchTerm"].",";
			}

			return $website_paid_keywords;

		} catch (Exception $ex) {
			return null;
		}

		return null;
	}



	public static function scrapeIPRange()
	{
		$cat_response = Scraper::filterText("http://www.shopify.com/examples", ".examples-grid-nav__item");

		foreach ($cat_response as $key => $row) {

			$cat_url 	= Scraper::getTagAttribute($row["raw"], 'a', 'href');
			
			$ex_response = Scraper::filterText("http://www.shopify.com/".$cat_url, ".store-examples-item");

			foreach ($ex_response as $key1 => $row1) {

				$address = trim(ucwords(Scraper::filterText($row1["raw"], ".store-examples-item__url", false)[0]["text"]));
				$ip_info = self::getIPInfo($address);

				$data = [
					"address" => $address,
					"range"	=> $ip_info["ip_range"]
				];

				self::storeIPRange($data);

			}

		}

		return "";
	}

	private static function getIPInfo($address)
	{
		$api_url = Config::get('api.myip.api_url');
		$query = $address;
		$api_id = Config::get('api.myip.api_id');
		$api_key = Config::get('api.myip.api_key');
		$timestamp = date('Y-m-d_h:i:s');

		$str = $api_url."/".$query."/api_id/".$api_id."/api_key/".$api_key."/timestamp/".$timestamp;
		$signature = md5($str);
		$url = $api_url."/".$query."/api_id/".$api_id."/api_key/".$api_key."/signature/".$signature."/timestamp/".$timestamp;

		$response = Scraper::get($url, "json");

        $rData["ip_address"] = $response["ip_address"];
        $rData["ip_range"] = $response["owners"]["owner"]["range"];

		return $rData;
	}

	private static function storeIPRange($data)
	{
		$validator = Validator::make($data, IpRanges::$rules);

		if ($validator->fails())
		{
			return $validator->messages()->toJson();
		}

		if (IpRanges::checkIPRange($data) > 0) return;

		return IpRanges::create($data);
	}
	
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

	//collect website from myip.ms
	
	public static function collectSite()
	{
		$from_ip = "23.227.32.0";
		$to_ip = "23.227.63.255";

		$cnt = Sites::countAll();
		$page = (int)($cnt /50) + 1;

		try {
			$url = "http://myip.ms/browse/sites/".$page."/ipID/".$from_ip."/ipIDii/".$to_ip;
		    $response = Scraper::filterText($url, "#sites_tbl tbody tr");

		    if ($response == null) {
		    	echo $url."--null<br>";
				$page++;
				return;
			} else {
				
				$i = 1;

				foreach ($response as $key => $row) {
					if ($i % 2 == 1) {
						$website = trim(ucwords(Scraper::filterText($row["raw"], ".row_name", false)[0]["text"]));

						$data = [
							"website" => $website
						];

						self::storeSite($data);
					}

					$i++;
				}

			}

		} catch (RequestException $ex) {
            error_log("CURL exception: " . $ex);
        }

		return "well done";
	}

	private static function storeSite($data)
	{
		$validator = Validator::make($data, Sites::$rules);

		if ($validator->fails())
		{
			return $validator->messages()->toJson();
		}

		if (Sites::checkSite($data) > 0) return;

		return Sites::create($data);
	}


}
