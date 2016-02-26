<?php namespace Libraries\IPNListener;

interface IPNListenerInterface
{
	public function handle(PayloadRequestInterface $payload);
}