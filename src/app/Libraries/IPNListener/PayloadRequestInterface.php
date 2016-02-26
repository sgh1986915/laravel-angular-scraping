<?php namespace Libraries\IPNListener;

interface PayloadRequestInterface
{
	/**
	 * @return bool
	 */
	public function validate();

	/**
	 * @return array
	 */
	public function getProducts();

	/**
	 * @return \Libraries\Zaxaa\Customer
	 */
	public function getCustomer();

	/**
	 * @return \Libraries\Zaxaa\Transaction
	 */
	public function getTransaction();
}