<?php namespace Libraries\Zaxaa\Handlers;

use Libraries\Zaxaa\Exception\InvalidTransactionTypeException;
use Libraries\Zaxaa\Transaction;

class HandlerFactory
{
	/**
	 * @param $transactionType
	 * @return \Libraries\Zaxaa\Handlers\TransactionHandlerInterface
	 * @throws \Libraries\Zaxaa\Exception\InvalidTransactionTypeException
	 */
	public function with($transactionType)
	{
		switch($transactionType)
		{
			case Transaction::TRANS_TYPE_SALE:
				return $this->createHandler('sale');

			case Transaction::TRANS_TYPE_FIRST_BILL:
				return $this->createHandler('sale');

			case Transaction::TRANS_TYPE_REBILL:
				return $this->createHandler('rebill');

			case Transaction::TRANS_TYPE_CANCELLED:
				return $this->createHandler('cancelled');

			case Transaction::TRANS_TYPE_REFUND:
				return $this->createHandler('cancelled');

			default: throw new InvalidTransactionTypeException('Unknown transactiontype ' . $transactionType);
		}
	}

	/**
	 * @param $type
	 * @return \Libraries\Zaxaa\Handlers\TransactionHandlerInterface
	 */
	protected function createHandler($type)
	{
		$handler = 'Libraries\\Zaxaa\\Handlers\\' . studly_case($type) . 'TransactionHandler';
		return app($handler);
	}
}