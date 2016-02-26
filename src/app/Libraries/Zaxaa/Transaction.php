<?php namespace Libraries\Zaxaa;

use DateTime;
use Libraries\Zaxaa\Exception\InvalidTransactionTypeException;

class Transaction
{
	const TRANS_TYPE_SALE = 0;

	const TRANS_TYPE_FIRST_BILL = 1;

	const TRANS_TYPE_REBILL = 2;

	const TRANS_TYPE_CANCELLED = 3;

	const TRANS_TYPE_REFUND = 4;

	/**
	 * @var string
	 */
	private $type;

	/**
	 * @var \DateTime
	 */
	private $date;

	/**
	 * @var float
	 */
	private $amount;

	/**
	 * @var string
	 */
	private $currency;

	/**
	 * @var string
	 */
	private $receiptNumber;

	/**
	 * @var string
	 */
	private $sellerId;

	/**
	 * @var string
	 */
	private $sellerEmail;

	public function __construct($type, DateTime $date, $amount, $currency, $receiptNumber, $sellerId, $sellerEmail)
	{
		$this->type = $type;
		$this->date = $date;
		$this->amount = $amount;
		$this->currency = $currency;
		$this->receiptNumber = $receiptNumber;
		$this->sellerId = $sellerId;
		$this->sellerEmail = $sellerEmail;
	}

	/**
	 * @return float
	 */
	public function getAmount()
	{
		return $this->amount;
	}

	/**
	 * @return string
	 */
	public function getCurrency()
	{
		return $this->currency;
	}

	/**
	 * @return DateTime
	 */
	public function getDate()
	{
		return $this->date;
	}

	/**
	 * @return string
	 */
	public function getReceiptNumber()
	{
		return $this->receiptNumber;
	}

	/**
	 * @return string
	 */
	public function getSellerEmail()
	{
		return $this->sellerEmail;
	}

	/**
	 * @return string
	 */
	public function getSellerId()
	{
		return $this->sellerId;
	}

	/**
	 * @throws \Libraries\Zaxaa\Exception\InvalidTransactionTypeException
	 * @return int
	 */
	public function getType()
	{
		switch($this->type)
		{
			case 'SALE': return self::TRANS_TYPE_SALE;

			case 'FIRST_BILL': return self::TRANS_TYPE_FIRST_BILL;

			case 'REBILL': return self::TRANS_TYPE_REBILL;

			case 'CANCELED': return self::TRANS_TYPE_CANCELLED;

			case 'REFUND': return self::TRANS_TYPE_REFUND;

			default:
				throw new InvalidTransactionTypeException('Transaction Type ' . $this->get('trans_type') . ' is not valid');
		}
	}
}