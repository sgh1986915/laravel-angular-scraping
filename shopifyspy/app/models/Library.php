<?php

class Library extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'user_id'	=> 'required',
		'thumbnail'	=> 'required',
		'src' 		=> 'required',
		'type'		=> 'required'

	];

	// Don't forget to fill this array
	protected $fillable = ['user_id', 'thumbnail', 'src', 'type'];

	public static function mine()
	{
		return self::where('user_id', '=', Sentry::getUser()->id)->get();
	}
}