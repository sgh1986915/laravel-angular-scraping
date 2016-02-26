<?php

class IpRanges extends \Eloquent {
	//protected $table = "ip_ranges";

	// Add your validation rules here
	public static $rules = [
		'range' 		=> 'required',
	];

	// Don't forget to fill this array
	protected $fillable = ['range'];

	public static function checkIPRange($data)
	{
		return DB::table("ip_ranges")->where("range", "=", $data["range"])->count();
	}

	public static function getAll()
	{
		return self::all();
	}

}