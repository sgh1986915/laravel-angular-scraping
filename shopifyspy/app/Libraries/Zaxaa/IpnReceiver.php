<?php namespace Libraries\Zaxaa;

use Libraries\IPNListener\IPNListenerInterface;
use Libraries\IPNListener\PayloadRequestInterface;
use Libraries\Zaxaa\Exception\InvalidIpnPayloadException;
use Libraries\Zaxaa\Handlers\HandlerFactory;

class IpnReceiver implements IPNListenerInterface
{

	/**
	 * @var \Libraries\Zaxaa\Handlers\HandlerFactory
	 */
	private $handler;

	public function __construct(HandlerFactory $handler)
	{
		$this->handler = $handler;
	}

	public function handle(PayloadRequestInterface $payload)
	{
		if( ! $payload->validate())
			throw new InvalidIpnPayloadException('IPN Payload is not valid.');

		$transaction = $payload->getTransaction();
		$customer = $payload->getCustomer();

		$this->handler->with($transaction->getType())->handle($transaction, $customer);
	}
}