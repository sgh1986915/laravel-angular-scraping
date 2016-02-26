<?php

class ShopifyExample extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'category'	=> 'required',
		'website_address' 		=> 'required',
	];

	// Don't forget to fill this array
	protected $fillable = ['category', 'website_address', 'ip_address', 'ip_range'];

}