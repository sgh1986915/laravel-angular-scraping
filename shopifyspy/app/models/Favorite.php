<?php

class Favorite extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'user' => 'required',
		'keyword' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ["user_id", "keyword"];

}