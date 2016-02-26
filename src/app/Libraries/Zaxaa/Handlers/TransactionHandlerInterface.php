<?php namespace Libraries\Zaxaa\Handlers;

use Libraries\Zaxaa\Customer;
use Libraries\Zaxaa\Transaction;

interface TransactionHandlerInterface
{
	public function handle(Transaction $transaction, Customer $customer);
}