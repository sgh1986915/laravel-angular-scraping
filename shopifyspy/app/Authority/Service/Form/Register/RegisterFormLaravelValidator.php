<?php namespace Authority\Service\Form\Register;

use Authority\Service\Validation\AbstractLaravelValidator;

class RegisterFormLaravelValidator extends AbstractLaravelValidator {
	
	/**
	 * Validation rules
	 *
	 * @var Array 
	 */
	protected $rules = array(
		'email' => 'required|min:4|max:32|email',
		'password' => 'required|min:6|confirmed',
		'password_confirmation' => 'required'
	);

	/**
	 * Custom Validation Messages
	 *
	 * @var Array 
	 */
	protected $messages = array(
		//'email.required' => 'An email address is required.'
	);
}