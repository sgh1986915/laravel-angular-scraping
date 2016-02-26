<?php

use GuzzleHttp\Client as GuzzleClient;
use Goutte\Client as Client;

use Symfony\Component\DomCrawler\Crawler;

class Scraper {

    public static $client;

    private static $url;
    private static $html;
    private static $crawler;
    private static $filters;
    private static $content = array();
	private static $proxies = array();
 
    public static function get($url, $format = "html", $cache = true)
    {

    	$cacheKey 		= Str::slug($url);
    	$cacheMinutes 	= 60;
    	$data 			= null;
    	
		if (!Cache::has($cacheKey) || $cache == false)
		{
			if ($format == "raw")
			{
				//$client		= new Client;
				
				
				/// I have added some proxy code in basecamp
				/// that should work.. i didnt have the time
				/// today to do it.
				/// but in short
				
				/*
				
				$res = $client->get('http://www.ipmango.com/api/myip', [
				'config' => [
					'curl' => [
						'CURLOPT_PROXY' => '194.135.220.18:8081',
						'CURLOPT_HTTPPROXYTUNNEL' => 1,
					],
				]);

				OR
				
				$client = new Client([
					'base_url' => [$url],
					'defaults' => [
						'proxy'   => 'tcp://80.79.122.190:8800'
					]
				]);				
			    $crawler 	= $client->request('GET');
		    	$data 		= $crawler->html();				
				
				// NOT sure which one works but this is a good start 
				// as we need to make all scrapper calls through proxies
				// we need to pick a random proxy below in
				
				getProxies()
				
				we need to suffle () so we can pass to Guzzle Client
	
				*/				
				
				
				//Ricky Set Proxies
				//$guzzle_c 	= $client->getClient();
				//$guzzle_c->setDefaultOption('proxy', $this->getProxies());
				//$client->setClient($guzzle_c);
				//end

				$client = new GuzzleClient([
					'base_url' => [$url],
					'defaults' => [
						'proxy'   => $this->getProxies()
					]
				]);				
			    $crawler 	= $client->request('GET');
		    	$data 		= $crawler->html();
				
			    /*$crawler 	= $client->request('GET', $url);
		    	$data 		= $crawler->html();*/
			}
		   	/**
		   	 * If its JSON we call the Guzzle Client Directly
		   	 * @var [type]
		   	 */
		   	elseif ($format == "json")
		   	{	
		   		$data 		= array();
		   		$client 	= new GuzzleClient();
				
				//Ricky Set Proxies
				//$client->getOptions()->set('curl.CURLOPT_PROXY', $this->getProxies());	
				//end		
				
				$response 	= $client->get($url);
				if ( $response->getStatusCode() == 200 ) {
					$data = $response->json();
				}
		   	}
		   	/**
		   	 * Otherwise we use the Goutte Client
		   	 */
		   	else 
		   	{ 
				//$client		= new Client;

				//Ricky Set Proxies
				//$guzzle_c 	= $client->getClient();
				//$guzzle_c->setDefaultOption('proxy', self::getProxies());
				//$client->setClient($guzzle_c);
				//end
				
			    //$crawler 	= $client->request('GET', $url);
		    	//$data 		= $crawler->html();

				/*
				('188.208.0.93:8800',
						'80.79.122.190:8800',
						'188.208.0.63:8800',
						'188.208.0.250:8800',
						'80.79.122.53:8800',
						'188.208.0.144:8800',
						'80.79.122.20:8800',
						'80.79.122.22:8800',
						'188.208.0.124:8800',
						'80.79.122.45:8800');
				*/


		    	$client = new Client();
				$guzzle = $client->getClient();
				$guzzle->setDefaultOption('proxy', self::getProxies());
				$client->setClient($guzzle);
				$crawler = $client->request('GET', $url);
				$data = $crawler->html();
		   	}

		    Cache::put($cacheKey, $data, $cacheMinutes);
		}

		return Cache::get($cacheKey);		

    }

    /**
     * HTML Parsing & Get in one
     * @param  [string] $url   		[URL]
     * @param  [string] $xpath 		[XPath]
     * @return [string] $content	[HTML]
     */
    public static function filterText($html, $xpath, $get = true)
    {
    	if ( $get ) {
	    	$crawler = new Crawler(self::get($html));
    	}
    	else {
    		$crawler = new Crawler($html);
    	}

    	$content = $crawler->filter($xpath)->each(function(Crawler $node, $i) {
	    	return 	[
				"text" 	=> $node->text(),
				"raw"	=> $node->html()
			];
        });

        return $content;
    }

    public static function getContent()
    {
    	return self::$content;
    }

    public static function getAnchorHref($html)
    {
    	return self::getTagAttribute($html, "a", "href");
    }

    public static function getImageSource($html)
    {

    	return self::getTagAttribute($html, "img", "src");
    }

    public static function getTagAttribute($html, $tag, $attribute)
    {

		$dom = new DOMDocument;

		@$dom->loadHTML($html, LIBXML_NOWARNING | LIBXML_ERR_NONE);
		
		$node = $dom->getElementsByTagName($tag);

        unset($dom);
        return $node->item(0)->getAttribute($attribute);
    }

    public static function getTagAttributeEx($html, $tag, $attribute, $index = 0)
    {

		$dom = new DOMDocument;

		@$dom->loadHTML($html, LIBXML_NOWARNING | LIBXML_ERR_NONE);
		
		$node = $dom->getElementsByTagName($tag);

        unset($dom);
        return $node->item($index)->getAttribute($attribute);
    }

    public static function getTagText($html, $tag)
    {
        $dom = new DOMDocument;

        @$dom->loadHTML($html, LIBXML_NOWARNING | LIBXML_ERR_NONE);
        
        $node = $dom->getElementsByTagName($tag);

        unset($dom);
		return $node->item(0)->nodeValue;
    }
	
	//Ricky Get Proxies
	public static function getProxies(){
		return array('188.208.0.93:8800',
						'80.79.122.190:8800',
						'188.208.0.63:8800',
						'188.208.0.250:8800',
						'80.79.122.53:8800',
						'188.208.0.144:8800',
						'80.79.122.20:8800',
						'80.79.122.22:8800',
						'188.208.0.124:8800',
						'80.79.122.45:8800');

		/*$this->proxies=array('188.208.0.93:8800',
							'80.79.122.190:8800',
							'188.208.0.63:8800',
							'188.208.0.250:8800',
							'80.79.122.53:8800',
							'188.208.0.144:8800',
							'80.79.122.20:8800',
							'80.79.122.22:8800',
							'188.208.0.124:8800',
							'80.79.122.45:8800');
		shuffle($this->proxies);
		return $this->proxies[0];*/

	}
	
}