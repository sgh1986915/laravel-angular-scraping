<?php namespace Libraries\Zaxaa\Handlers;

use Libraries\Zaxaa\Customer;
use Libraries\Zaxaa\Transaction;

class RebillTransactionHandler implements TransactionHandlerInterface
{
	public function handle(Transaction $transaction, Customer $customer)
	{
		// .. user is rebilled
	}
}