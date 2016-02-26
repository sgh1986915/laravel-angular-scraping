<?php

class Favorites extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'user_id' => 'required',
	];

	// Don't forget to fill this array
	protected $fillable = ["user_id", "keyword"];

	public static function mine()
	{
		return self::where('user_id', '=', Sentry::getUser()->id)->get();
	}
	
	public static function userRules($user_id)
	{
		static::$rules["keyword"] = "required|unique:favorites,keyword,NULL,id,user_id,{$user_id}";
		return self::$rules;
	}



}