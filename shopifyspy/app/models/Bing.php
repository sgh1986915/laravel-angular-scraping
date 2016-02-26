<?php

class Bing {

	public static function searchImages($query, $offset = 0)
	{
		$url = "http://www.bing.com/images/async?q={$query}&async=content&first={$offset}";

		$images = Scraper::filterText($url, ".dg_u");

		$data = array();

		foreach ($images as $key => $row) {

			$mData = Scraper::getTagAttribute($row["raw"], "a", "m");
			
			$mData = str_replace("}", null, $mData);
			$mData = str_replace("{", null, $mData);
			$mData = str_replace('"', null, $mData);

			$rArray = explode(',', $mData);

			foreach ($rArray as $rkey => $rrow) {
				$rrArray = explode(':', $rrow, 2);
				if ( is_array($rrArray) && isset($rrArray[1]) )
					$rData[$key][$rrArray[0]] = $rrArray[1];
			}

			$rData[$key]["src"] 	= Scraper::getTagAttribute($row["raw"], "img", "src2");
			$rData[$key]["title"] 		= Scraper::getTagAttribute($row["raw"], "a", "t1");

		}

		return $rData;
	}
}