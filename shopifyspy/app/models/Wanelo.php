<?php

class Wanelo {

	public static function searchEx($query, $style, $page = 1) {
		
		include(app_path().'/Libraries/simple_dom_html.php');

		$baseUrl = 'https://wanelo.com';

		$query = urlencode (utf8_encode($query));

	    $url = $baseUrl .'/search?query=' . $query;
	    $url .= '&page=' . $page;	    
	    if($style!='all'){
	    	$url .= '&style=' . $style; 
	    }    	 

		// Create DOM from URL
		$html = file_get_html($url);

		$prods = $html->find('div.js-paginated-product');

		if ($prods) {
			$data = array();

			foreach ($prods as $product) {

				// echo "<pre>";
				// print_r($product);
				// echo "</pre>";
				// exit();

				$img = $product->find('a img', 0);
				$imgUrl = $img->attr['src'];
	            $prodLinkDom = $product->find('a', 0);
	            $pLink = $prodLinkDom->attr['href'];

				$productInfo = $product->find('div.product-info h3', 0)->text();

				$price = $product->find('div.store-info span.price', 0)->text();

				$savesCount = $product->find('div.product-overlay span.js-saves-count', 0)->text();

				$data[] = array(

					'thumbUrl' => trim($imgUrl),

					'sUrl' => $baseUrl . trim($pLink),

					'caption' => trim($productInfo),

					'price' => trim($price),

					'savesCount' => trim($savesCount),

					);

			}

			// return $data;
			print json_encode($data);

        	exit;

	        // exit;

		}
	}
	  

}
