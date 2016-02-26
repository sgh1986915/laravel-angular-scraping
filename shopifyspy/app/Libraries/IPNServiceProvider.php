<?php namespace Libraries;

use Libraries\Zaxaa\IpnReceiver;
use Libraries\Zaxaa\PayloadRequest;
use Illuminate\Support\ServiceProvider;
use Libraries\Zaxaa\Handlers\HandlerFactory;

class IPNServiceProvider extends ServiceProvider
{
	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('Libraries\IPNListener\IPNListenerInterface', function()
		{
			return new IpnReceiver(new HandlerFactory());
		});

		$this->app->bind('Libraries\IPNListener\PayloadRequestInterface', function()
		{
			return PayloadRequest::createFromGlobals()
				->setSignatureKey($this->app['config']->get('zaxaa.signature'));
		});
	}
}