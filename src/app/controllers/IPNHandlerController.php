<?php

use Log;
use Response;
use Libraries\IPNListener\IPNListenerInterface;
use Libraries\IPNListener\PayloadRequestInterface;

class IPNHandlerController extends BaseController
{
	/**
	 * @var \Libraries\IPNListener\IPNListenerInterface
	 */
	private $ipnHandler;

	/**
	 * @var \Libraries\IPNListener\PayloadRequestInterface
	 */
	private $payload;

	public function __construct(IPNListenerInterface $ipnHandler, PayloadRequestInterface $payload)
	{
		$this->ipnHandler = $ipnHandler;
		$this->payload = $payload;
	}

	public function handle()
	{
		Log::notice('handling IPN request');
		Log::notice(json_encode($this->payload->all()));

		try
		{
			$this->ipnHandler->handle($this->payload);

			Log::notice('Returning good response');
			return Response::make('All good.', 200);
		}
		catch(Exception $e)
		{
			Log::error((string) $e);
			Log::notice('Returning bad response');
			return Response::make('Error', 500);
		}
	}
}