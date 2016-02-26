<?php

class Google {

	public static function searchImages($query, $offset = 0)
	{
		$url = "http://images.google.com/images?safe=off&q={$query}&start={$offset}&sa=N";

		$images = Scraper::filterText($url, ".images_table td");

    	foreach ($images as $key => $row) {
            $mData = Scraper::getTagAttribute($row["raw"], "a", "href");
            
            $rData[$key]["surl"] = substr($mData, 7, strpos($mData, "&sa=")-7);
            $rData[$key]["url"] = Scraper::getTagAttribute($row["raw"], "img", "src");
            $rData[$key]["thumbUrl"] = Scraper::getTagAttribute($row["raw"], "img", "src");
            $rData[$key]["caption"] = "";
        }

		return $rData;
	}

    public static function searchImagesEx($query, $offset = 0)
    {
        $url = "https://ajax.googleapis.com/ajax/services/search/images?v=1.0&q={$query}&start=$offset&rsz=4";

        $images = Scraper::get($url, "json");

        foreach ($images["responseData"]["results"] as $key => $row) {
            $rData[$key]["surl"] = $row["originalContextUrl"];
            $rData[$key]["url"] = $row["url"];
            $rData[$key]["thumbUrl"] = $row["tbUrl"];
            $rData[$key]["caption"] = $row["title"];
        }

        return $rData;
    }

    public static function searchImagesEx1($query, $offset = 0)
    {
        $url = "https://ajax.googleapis.com/ajax/services/search/images?v=1.0&q={$query}&start=$offset&rsz=8";

        $images = Scraper::get($url, "json");

        echo '<pre>';
        var_dump($images["responseData"]["results"]);
        
        foreach ($images["responseData"]["results"] as $key => $row) {
            $rData[$key]["surl"] = $row["originalContextUrl"];
            $rData[$key]["url"] = $row["url"];
            $rData[$key]["thumbUrl"] = $row["tbUrl"];
            $rData[$key]["caption"] = $row["title"];
        }

        echo '--------------------------------------------------';
        var_dump($rData);

        return $rData;
    }
}