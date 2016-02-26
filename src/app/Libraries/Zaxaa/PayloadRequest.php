<?php namespace Libraries\Zaxaa;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Libraries\IPNListener\PayloadRequestInterface;

class PayloadRequest extends Request implements PayloadRequestInterface
{

	/**
	 * @var string
	 */
	protected $signatureKey;

	/**
	 * @param array $signatureKey
	 */
	public function setSignatureKey($signatureKey)
	{
		$this->signatureKey = $signatureKey;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function validate()
	{
		if( ! $this->has('trans_type')) return false;

		$transReceipt = $this->get('trans_receipt');
		$transAmount = $this->get('trans_amount');
		$sellerID = $this->get('seller_id');
		$hashKey = $this->get('hash_key');

		$hash = $sellerID . $this->getSignature() . $transReceipt . $transAmount;

		return $hashKey == strtoupper(md5($hash));
	}

	/**
	 * @return mixed
	 */
	public function getProducts()
	{
		return $this->get('products');
	}

	/**
	 * @return \Libraries\Zaxaa\Transaction
	 */
	public function getTransaction()
	{
		$type = $this->get('trans_type');
		$date = Carbon::now();
		$amount = $this->get('trans_amount');
		$currency = $this->get('trans_currency');
		$receiptNumber = $this->get('trans_receipt');
		$sellerId = $this->get('seller_id');
		$sellerEmail = $this->get('seller_email');

		return new Transaction($type, $date, $amount, $currency, $receiptNumber, $sellerId, $sellerEmail);
	}

	/**
	 * @return \Libraries\Zaxaa\Customer
	 */
	public function getCustomer()
	{
		return new Customer(
			$this->get('cust_email'), $this->get('cust_firstname'), $this->get('cust_lastname'),
			$this->get('cust_address'), $this->get('cust_state'), $this->get('cust_city'), $this->get('cust_country')
		);
	}

	/**
	 * @return string
	 */
	private function getSignature()
	{
		return $this->signatureKey;
	}
}