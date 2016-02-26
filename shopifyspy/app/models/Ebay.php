<?php

use \DTS\eBaySDK\Constants;
use \DTS\eBaySDK\Finding\Services;
use \DTS\eBaySDK\Finding\Types;
use \DTS\eBaySDK\Finding\Enums\OutputSelectorType;	

class Ebay {
	
	public static function search($query, $page = 1) {

		// Create the service object.
		$service = new Services\FindingService(array(
		    'appId'		=> 'JoaoGilV-e88f-4417-9262-abde51e116ea',
		    'globalId' 	=> Constants\GlobalIds::US
		));

		// Create the request object.
		$request = new Types\FindItemsByKeywordsRequest();

		$request->outputSelector = ['PictureURLLarge', 'listingInfo'];

		$request->keywords = $query;

		/**
		 * Limit the results to 10 items per page.
		 */
		$request->paginationInput = new Types\PaginationInput();
		$request->paginationInput->entriesPerPage = 10;

		for ($pageNum = 1; $pageNum <= $page; $pageNum++ ) {

			$request->paginationInput->pageNumber = $pageNum;

			// Send the request to the service operation.
			$response = $service->findItemsByKeywords($request);

			if ($pageNum == $page) {
				$i = 0;
				foreach ($response->searchResult->item as $item) {

		            $data[$i] = [
		    			"id" 			=> $item->itemId,
						"title" 		=> $item->title,
						"subtitle"		=> $item->subtitle,
						"info"			=> $item->listingInfo,
						"thumb"			=> $item->galleryURL,
						"thumb_large"	=> $item->pictureURLLarge,
						"url"			=> $item->viewItemURL,
						"currency" 		=> $item->sellingStatus->currentPrice->currencyId,
						"price" 		=> $item->sellingStatus->currentPrice->value,
					];
		            $i++;
				}
			}
		}

		return $data;
	}

	public static function searchEx($query, $page = 1) {

		// Create the service object.
		$service = new Services\FindingService(array(
		    'appId'		=> 'JoaoGilV-e88f-4417-9262-abde51e116ea',
		    'globalId' 	=> Constants\GlobalIds::US
		));

		// Create the request object.
		$request = new Types\FindItemsByKeywordsRequest();

		$request->outputSelector = ['PictureURLLarge', 'listingInfo'];

		$request->keywords = $query;

		/**
		 * Limit the results to 10 items per page.
		 */
		$request->paginationInput = new Types\PaginationInput();
		$request->paginationInput->entriesPerPage = 10;

		for ($pageNum = 1; $pageNum <= $page; $pageNum++ ) {

			$request->paginationInput->pageNumber = $pageNum;

			// Send the request to the service operation.
			$response = $service->findItemsByKeywords($request);

			if ($pageNum == $page) {
				$i = 0;
				foreach ($response->searchResult->item as $item) {

		            $data[$i] = [
		    			"id" 			=> $item->itemId,
						"title" 		=> $item->title,
						"subtitle"		=> $item->subtitle,
						"info"			=> $item->listingInfo,
						"thumbUrl"		=> $item->galleryURL,
						"url"			=> $item->pictureURLLarge,
						"surl"			=> $item->viewItemURL,
						"currency" 		=> $item->sellingStatus->currentPrice->currencyId,
						"price" 		=> $item->sellingStatus->currentPrice->value,
					];

		            $i++;
				}
			}
		}

		return $data;
	}
}
/*
itemId: "190928626514",
title: "Lorde - Pure Heroine (CD 2013) Royal Brand New & Sealed",
globalId: "EBAY-US",
primaryCategory: { },
galleryURL: "http://thumbs3.ebaystatic.com/m/mGafz_dwh8TspX2QMYIaaQQ/140.jpg",
viewItemURL: "http://www.ebay.com/itm/Lorde-Pure-Heroine-CD-2013-Royal-Brand-New-Sealed-/190928626514?pt=Music_CDs",
productId: { },
paymentMethod: { },
autoPay: false,
location: "China",
country: "CN",
shippingInfo: { },
sellingStatus: { },
listingInfo: { },
returnsAccepted: true,
condition: { },
isMultiVariationListing: false,
topRatedListing: true
 */