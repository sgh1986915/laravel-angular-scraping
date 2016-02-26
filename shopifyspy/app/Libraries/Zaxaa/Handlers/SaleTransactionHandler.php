<?php namespace Libraries\Zaxaa\Handlers;

use Carbon\Carbon;
use Illuminate\Mail\Mailer;
use Cartalyst\Sentry\Sentry;
use Illuminate\Mail\Message;
use Libraries\Zaxaa\Customer;
use Libraries\Zaxaa\Transaction;
use Cartalyst\Sentry\Users\UserNotFoundException;

class SaleTransactionHandler implements TransactionHandlerInterface
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
		}
		catch(UserNotFoundException $e)
		{
			$tempPassword = 'changeme';
			$email  = $customer->getEmail();

			$user = $this->sentry->createUser([
				'email' => $email,
				'password' => $tempPassword,
			    'activated' => 1,
			    'activated_at' => Carbon::now()
			]);

			$viewData = [
				'email' => $email,
				'password' => $tempPassword,
			    'name' => $customer->getFirstName()
			];

			$this->mailer->send('emails.welcome', $viewData, function(Message $mail) use($email)
			{
				$mail->to($email);
				$mail->subject('Your Instant Trends Machine Login Information');
			});
		}
	}
}