<?php

class ShopifySite extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'user_id'	=> 'required',
		'category'	=> 'required',
		'site_address' 		=> 'required',
	];

	// Don't forget to fill this array
	protected $fillable = ['user_id', 'category', 'site_address', 'ip_address', 'ip_range'];

}