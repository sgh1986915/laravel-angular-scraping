<?php namespace Libraries\Zaxaa\Handlers;

use Cartalyst\Sentry\Users\UserNotFoundException;
use Illuminate\Mail\Mailer;
use Cartalyst\Sentry\Sentry;
use Illuminate\Mail\Message;
use Libraries\Zaxaa\Customer;
use Libraries\Zaxaa\Transaction;

class CancelledTransactionHandler implements TransactionHandlerInterface
{
	/**
	 * @var \Cartalyst\Sentry\Sentry
	 */
	private $sentry;

	/**
	 * @var \Illuminate\Mail\Mailer
	 */
	private $mailer;

	public function __construct(Sentry $sentry, Mailer $mailer)
	{
		$this->sentry = $sentry;
		$this->mailer = $mailer;
	}

	public function handle(Transaction $transaction, Customer $customer)
	{
		try
		{
			$user = $this->sentry->findUserByLogin($customer->getEmail());
			$user->delete();

			$this->mailer->queue('emails.terminated', [], function(Message $mail) use ($customer)
			{
				$mail->to($customer->getEmail());
			});
		}
		catch(UserNotFoundException $e)
		{
			//.. User does not exist, bail out
		}
	}
}