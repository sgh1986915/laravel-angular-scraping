<?php

class Sites extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'website' 		=> 'required',
	];

	// Don't forget to fill this array
	protected $fillable = ['website', 'traffic_volume', 'global_rank', 'global_traffic'];

	public static function getAll()
	{
		$website = self::orderBy('traffic_volume', 'desc')->get();

		foreach ($website as $key => $row) {

			$data[] = [
					"website" => $row["website"],
					"traffic_volume" => ($row["traffic_volume"] != null) ? number_format($row["traffic_volume"]) : "",
					"global_rank" => $row["global_rank"],
					"global_traffic" => $row["global_traffic"],
					"best_seller" => "http://".$row["website"]."/collections/all?sort_by=best-selling",
					"traffic_stats" => "http://www.similarweb.com/website/".$row["website"],
				];

		}

		return json_encode($data);
	}

	public static function countAll()
	{
		return DB::table("sites")->count();
	}
	
	public static function checkSite($data)
	{
		return DB::table("sites")->where("website", "=", $data["website"])->count();
	}

}