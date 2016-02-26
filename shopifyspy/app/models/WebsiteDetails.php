<?php

class WebsiteDetails extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'website_id' 		=> 'required',
	];

	// Don't forget to fill this array
	protected $fillable = ['website_id', 'website_tags', 'website_organic_keywords', 'website_paid_keywords'];

	public static function checkWebsiteDetails($website_id)
	{
		return DB::table("website_details")->where("website_id", "=", $website_id)->count();
	}

}