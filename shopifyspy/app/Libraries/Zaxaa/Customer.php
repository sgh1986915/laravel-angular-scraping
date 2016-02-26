<?php namespace Libraries\Zaxaa;

class Customer
{
	/**
	 * @var string
	 */
	private $email;

	/**
	 * @var string
	 */
	private $firstName;

	/**
	 * @var string
	 */
	private $lastName;

	/**
	 * @var string
	 */
	private $address;

	/**
	 * @var string
	 */
	private $city;

	/**
	 * @var string
	 */
	private $state;

	/**
	 * @var string
	 */
	private $country;

	public function __construct($email, $firstName, $lastName, $address, $city, $state, $country)
	{
		$this->email = $email;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->address = $address;
		$this->city = $city;
		$this->state = $state;
		$this->country = $country;
	}

	/**
	 * @return string
	 */
	public function getAddress()
	{
		return $this->address;
	}

	/**
	 * @return string
	 */
	public function getCity()
	{
		return $this->city;
	}

	/**
	 * @return string
	 */
	public function getCountry()
	{
		return $this->country;
	}

	/**
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @return string
	 */
	public function getFirstName()
	{
		return $this->firstName;
	}

	/**
	 * @return string
	 */
	public function getLastName()
	{
		return $this->lastName;
	}

	/**
	 * @return string
	 */
	public function getState()
	{
		return $this->state;
	}
}