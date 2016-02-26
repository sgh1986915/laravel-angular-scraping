<?php
class DuckDuckGo {

	private static function getCleanRelation($string)
	{

		$relation = str_replace("https://duckduckgo.com/", "", $string);

		$dashpos = strpos($relation, "/");
		if ( $dashpos )
		{
			$relation = substr($relation, $dashpos+1);
		}

		$relation = str_replace("(", "", $relation);
		$relation = str_replace(")", "", $relation);
		$relation = str_replace("_", " ", $relation);

		$relation = ucwords(urldecode($relation));

		return $relation;
	}
	
	public static function instantSearch($query)
	{
		$url 	= "http://api.duckduckgo.com/?q={$query}&format=json&pretty=1";

		$result =  Scraper::get($url, "json");

		$topics = [];

		foreach ($result["RelatedTopics"] as $key => $row) 
		{
			if( isset($row["Result"]) ) 
			{
				$row["Result"] = str_ireplace("</a>", "</a>. ", $row["Result"]);
				
				$relation = self::getCleanRelation($row["FirstURL"]);
				
				$topics[] = [
					"text"		=> ucwords(strip_tags($row["Result"])),
					"image" 	=> $row["Icon"]["URL"],
					"relation"	=> $relation,
					"tag"		=> "Misc",
				];
			}
			/**
			 * If we have a row called topics then its a list of sub topics.
			 */
			if ( isset($row["Topics"]) )
			{

				foreach ($row["Topics"] as $subkey => $subrow) 
				{

					$subrow["Result"] = str_ireplace("</a>", "</a>. ", $subrow["Result"]);

					$relation = self::getCleanRelation($subrow["FirstURL"]);

					$topics[] = [
						"text"		=> strip_tags($subrow["Result"]),
						"image" 	=> $subrow["Icon"]["URL"],
						"relation"	=> $relation,
						"tag"		=> ucwords($row["Name"]),
					];
				}
			}
		}

		$results = array();

		if ( isset($result["Results"]) )
		{
			foreach ($result["Results"] as $key => $row) {

				$results[] = [
					"match" => ucwords($row["Result"]),
					"image"	=> ucwords($row["Icon"]["URL"]),
					"url"	=> ucwords($row["FirstURL"]),
					"type"	=> ucwords($row["Text"]),
				];

			}
		}

		$data["topics"] = $topics;

		$data["info"]	= [

			"heading" 		=> ucwords($result["Heading"]),
			"infoURL" 		=> ucwords($result["AbstractURL"]),
			"infoSource"	=> ucwords($result["AbstractSource"]),
			"definition"	=> $result["Definition"],
			"image"			=> ucwords($result["Image"]),
			"text"			=> ucwords($result["AbstractText"]),
			"results"		=> $results
		];
		return $data;

	}

}