<?php

class EbayWatchCount {

	protected static $s_endpoint = "http://open.api.ebay.com/shopping?";  // Shopping URL to call
	protected static $cellColor = "bgcolor=\"#dfefff\"";  // Light blue background used for selected items 
	protected static $m_endpoint = 'http://svcs.ebay.com/MerchandisingService?';  // Merchandising URL to call
	protected static $appid = 'mvc06473a-def8-429b-a064-1e9397b0232';  // You will need to supply your own AppID
	// protected static $appid = 'JoaoGilV-e88f-4417-9262-abde51e116ea';
	protected static $responseEncoding = 'XML';  // Type of response we want back

	public static function searchEx($query, $category, $sort, $order, $page) {
		return self::getMostWatchedItemsResults($query, $category, $sort, $order, $page, '', '');
	}

	 // Create a function for the getMostWatchedItems call 
	private static function getMostWatchedItemsResults ($query, $category, $_sort, $_order, $page, $selectedItemID = '', $cellColor = '') {
				
		$data = array();
	    //GET QUERY
	    //================================

	    if( $query!='' || $query!='undefined' ){
	    	
	    	$query = urlencode (utf8_encode($query));

	    	$apicall = "http://svcs.ebay.com/services/search/FindingService/v1?"
			           ."OPERATION-NAME=findItemsByKeywords&"
			           ."SERVICE-VERSION=1.0.0&"
			           ."SECURITY-APPNAME=".self::$appid."&"
			           ."RESPONSE-DATA-FORMAT=XML&"
			           ."REST-PAYLOAD&"
			           ."keywords=".$query
			           // ."&sortOrder=BestMatch"
			           // ."&itemFilter.name=MaxPrice&"
			           // ."itemFilter.value=10.00&"
			           // ."itemFilter.paramName=Currency&"
			           // ."itemFilter.paramValue=USD&"
			           ."&paginationInput.pageNumber=".$page
			           ."&paginationInput.entriesPerPage=20";	

			
			if($_sort!='' && $_sort!='none'){

				switch($_sort){
					case 'price': 
							if($_order=='asc'){
								$apicall .= "&sortOrder=PricePlusShippingLowest";
							}else{
								$apicall .= "&sortOrder=PricePlusShippingHighest";
							}
					break;
					// case 'timeLeft': 
					// 		if($_order=='asc'){
					// 			$apicall .= "&sortOrder=StartTimeNewest";
					// 		}else{
					// 			$apicall .= "&sortOrder=EndTimeSoonest";
					// 		}
					// break;
					// case 'watchCount': 
					// 		if($_order=='asc'){
					// 			$apicall .= "&sortOrder=BidCountFewest";
					// 		}else{
					// 			$apicall .= "&sortOrder=BidCountMost";
					// 		}
					// break;
					default: $apicall .= "&sortOrder=BestMatch"; break;
				}				
			}else{
				$apicall .= "&sortOrder=BestMatch";
			}
					

		    $resp = simplexml_load_file($apicall);

		    $dummyData = array(); $itemIDArr = array();
		    if($resp){
		        if ($resp->ack == "Success") {           
		            foreach($resp->searchResult->item as $i) {

		                $item_ID = (string)$i->itemId;
		                $itemIDArr[] = $item_ID;
		                $dummyData[$item_ID] = array(
		                            "id"            => $item_ID,
		                            "caption"       => $i->title,
		                            "thumbUrl"      => $i->galleryURL,
		                            "watchCount"    => '0',
		                            "viewItemURL"   => $i->viewItemURL,
		                            "timeLeft"      => self::getPrettyTimeFromEbayTime($i->sellingStatus->timeLeft),
		                            "pastSales"     => '0',
		                            "price"         => $i->sellingStatus->currentPrice
		                        );

		            }                        
		        }
		    }

		    //GET WATCHCOUNT BY POPULARITEMS
		    //==============================
		    if(count($itemIDArr)>0){

				// $getMostWatched = "http://svcs.ebay.com/MerchandisingService?"
				//          . "OPERATION-NAME=getMostWatchedItems&"
				//          . "SERVICE-NAME=MerchandisingService&"
				//          . "SERVICE-VERSION=1.1.0&"
				//          . "CONSUMER-ID=".self::$appid."&"
				//          . "RESPONSE-DATA-FORMAT=XML&"
				//          . "REST-PAYLOAD&"
				//          . "maxResults=50";

				$getMostWatched = "http://open.api.ebay.com/shopping?"
			           ."callname=FindPopularItems&"
			           ."responseencoding=XML&"
			           ."appid=".self::$appid."&"
			           ."siteid=0&"			           
			           ."version=531&"
			           ."MaxEntries=50&"
			           ."QueryKeywords=".$query;

				if($category!='none'){
					$getMostWatched .="&CategoryID=".$category;
				}

		        $mostWatched = simplexml_load_file($getMostWatched);

		        //GET WATCHCOUNT
		        //=================================
		        if($mostWatched){
			        if ($mostWatched->Ack == "Success") {  
			        	foreach($mostWatched->ItemArray->Item as $i) {
			        		$item_ID = (string)$i->ItemID;
			        		$itemIDArr2[] = $item_ID;
			        		if(in_array($item_ID, $itemIDArr)){	
			        			//update watchcount		        			
			        			$dummyData[$item_ID]["watchCount"] = $i->WatchCount;			        			
			        		}

			        	}
			        }
			    }

		    }


		    //GET PAST SALES
		    //==============================
		    if(count($itemIDArr)>0){
		    	//do another call to get PAST SALES
			    $apicall = "http://open.api.ebay.com/shopping?"
			           ."callname=GetMultipleItems&"
			           ."responseencoding=XML&"
			           ."appid=".self::$appid."&"
			           ."siteid=0&"
			           ."version=525&"
			           ."IncludeSelector=Details&"
			           ."ItemID=".implode(",",$itemIDArr);

			    $resp = simplexml_load_file($apicall);
			
			    //update pastSales
			    if($resp){
			        if ($resp->Ack == "Success") {            
			            foreach($resp->Item as $item) {
			                $item_ID = (string)$item->ItemID;
			                $pastSales = '0';
			                if($item->QuantitySold>0) $pastSales = $item->QuantitySold;
			                $dummyData[$item_ID]["pastSales"] = $pastSales;
			            }                        
			        }
			    }

	
			    //APPLY SORT
			    //================================
			    if($_sort=='' || $_sort=='none' ){
			    	$_sort = 'watchCount';
				}
					$sortArr = array();
					foreach($dummyData as $k=>$v) {
						
						switch ($_sort) {
							case 'price': $sortArr['price'][$k] = (int)$v['price'];	break;
							case 'pastSales': $sortArr['pastSales'][$k] = (int)$v['pastSales'];	break;
							case 'watchCount': $sortArr['watchCount'][$k] = (int)$v['watchCount'];	break;
							default: $sortArr['watchCount'][$k] = (int)$v['price'];	break;
						}				    
					}

					if($_order!='' && $_order!='none'){
						if($_order=='asc'){
							array_multisort($sortArr[$_sort], SORT_ASC, $dummyData);
						}else{
							array_multisort($sortArr[$_sort], SORT_DESC, $dummyData);
						}
					}else{
						array_multisort($sortArr[$_sort], SORT_DESC, $dummyData);	
					}					
				// }		


			    //reformat data
			    $i = 0;
			    foreach ($dummyData as $key => $value) {			    	

			    	$data[$i] = $dummyData[$key];
			    $i++;
			    }
		    }		

		}else{
			
			//show random values
			$categ = [20081,550,2984,267,12576,625,11450,11116,1,58058,293,14339,11232,45100,26395,11700,281,15032,11233,173484,870,10542,382,64482,260,220,9800,6028,1249,172008,99];
			$categoryId = $categ[rand(0,30)];



			$apicalla  = self::$m_endpoint;
		    $apicalla .= "OPERATION-NAME=getMostWatchedItems";
		    $apicalla .= "&SERVICE-VERSION=1.0.0";
		    $apicalla .= "&CONSUMER-ID=".self::$appid;
		    $apicalla .= "&RESPONSE-DATA-FORMAT=".self::$responseEncoding;
		    $apicalla .= "&maxResults=5";		    	    

		    if($category!='none'){
				$apicalla .="&categoryId=".$category;
			}else{
				// $apicalla .= "&categoryId=220"; 
				$apicalla .="&categoryId=".$categoryId; 
			}

		    $resp = simplexml_load_file($apicalla);

		    $i = 0;		    
		    // For each item node, build a table cell and append it to $retna 
		    foreach($resp->itemRecommendations->item as $item) {
		      	
		        // Set the cell color blue for the selected most watched item
		        if ($selectedItemID == $item->itemId) {
		          $thisCellColor = self::$cellColor ;
		        } else {
		          $thisCellColor = '';
		        }

		        // Determine which price to display
		        if ($item->currentPrice) {
		        	$price = $item->currentPrice;
		        } else {
		        	$price = $item->buyItNowPrice;
		        }
				
				$data[$i] = [
				    			"id" 			=> $item->itemId,
								"caption" 		=> $item->title,
								"thumbUrl" 		=> $item->imageURL,
								"watchCount" 	=> $item->watchCount,
								"viewItemURL"	=> $item->viewItemURL,
								"timeLeft"		=> self::getPrettyTimeFromEbayTime($item->timeLeft),
								"currency"		=> '',
								// "currency" 		=> $item->sellingStatus->currentPrice->currencyId,
								"price" 		=> $price
							];
	            $i++;
		    }
		}

		
	    return $data;

	} // End of getMostWatchedItemsResults function


	  // Use itemId from selected most watched item as input for a GetSingleItem call
	private static function getSingleItemResults ($selectedItemID) {

	    $retnb  = '';

	    // Construct the GetSingleItem call 
	    $apicallb  = self::$s_endpoint;
	    $apicallb .= "callname=GetSingleItem";
	    $apicallb .= "&version=563";
	    $apicallb .= "&appid=".self::$appid;
	    $apicallb .= "&itemid=".$selectedItemID;
	    $apicallb .= "&responseencoding=".self::$responseEncoding;
	    $apicallb .= "&includeselector=Details,ShippingCosts";

	    // Load the call and capture the document returned by eBay API
	    $resp = simplexml_load_file($apicallb);
	    
	    // Check to see if the response was loaded, else print an error
	    if ($resp) {

	       // If there is a response check for a picture of the item to display
	      if ($resp->Item->PictureURL) {
	      $picURL = $resp->Item->PictureURL;
	      } else {
	      $picURL = "http://pics.ebaystatic.com/aw/pics/express/icons/iconPlaceholder_96x96.gif";
	      }

	      // Check for shipping cost information
	      if ($resp->Item->ShippingCostSummary->ShippingServiceCost) {
	      $shippingCost = "\$" . $resp->Item->ShippingCostSummary->ShippingServiceCost;
	      } else {
	      $shippingCost = "Not Specified";
	      }

	      // Build a table of item and user details for the selected most watched item
	      $retnb .= "<!-- start table in getSingleItemResults --> \n";
	      $retnb .= "<table width=\"100%\" cellpadding=\"5\"><tr> \n";
	      $retnb .= "<td self::$cellColor  width=\"50%\">\n";
	      $retnb .= "<div align=\"left\"> <!-- left align item details --> \n";
	      $retnb .= "Current price: <b>\$" . $resp->Item->ConvertedCurrentPrice . "</b><br> \n";
	      $retnb .= "Shipping cost: <b>" . $shippingCost . "</b><br>\n";
	      $retnb .= "Time left: <b>" . self::getPrettyTimeFromEbayTime($resp->Item->TimeLeft) . "</b><br> \n";
	      $retnb .= "</div></td> \n";
	      $retnb .= "<td $cellColor><div align=\"left\"> <!-- left align item details --> \n";
	      $retnb .= "Seller ID: <b>" . $resp->Item->Seller->UserID . "</b><br> \n";
	      $retnb .= "Feedback score: <b>" . $resp->Item->Seller->FeedbackScore . "</b><br> \n";
	      $retnb .= "Positive Feedback: <b>" . $resp->Item->Seller->PositiveFeedbackPercent . "</b><br>\n";
	      $retnb .= "</div></td></tr></table> \n<!-- finish table in getSingleItemResults --> \n"; 

	    } else {
	    // If there was no response, print an error
	    $retnb = "Dang! Must not have got the GetSingleItem response!";  
	    }  // if $resp

	    return $retnb;

	  } // End of getSingleItemResults function 


	  // Use itemId from selected most watched item as input for a getRelatedCategoryItems call
	private static function getRelatedCategoryItemsResults ($selectedItemID) {

	    // Construct the getRelatedCategoryItems call
	    $apicallc  = "self::$m_endpoint ";
	    $apicallc .= "OPERATION-NAME=getRelatedCategoryItems";
	    $apicallc .= "&SERVICE-VERSION=1.0.0";
	    $apicallc .= "&CONSUMER-ID=self::$appid ";
	    $apicallc .= "&RESPONSE-DATA-FORMAT=self::$responseEncoding ";
	    $apicallc .= "&maxResults=3";
	    $apicallc .= "&itemId=$selectedItemID";

	    // Load the call and capture the document returned by eBay API
	    $resp = simplexml_load_file($apicallc);
	    
	    // Check to see if the response was loaded, else print an error
	    if ($resp) {

	      $retnc = '';
	    
	    // Verify whether call was successful
	    if ($resp->ack == "Success") {

	        // If there were no errors, build a table for the 3 related category items
	        $retnc .= "<!-- start table in getRelatedCategoryItemsResults --> \n";
	        $retnc .= "<table width=\"100%\" cellpadding=\"5\" border=\"0\" bgcolor=\"#FFFFA6\"><tr> \n";
	        $retnc .= "<td colspan=\"3\"><b>eBay shoppers that liked items in the selected ";
	        $retnc .= "item's category also liked items like the following from related categories:</b>";
	        $retnc .= "</td></tr><tr> \n";
	        
	        // If the response was loaded, parse it and build links  
	        foreach($resp->itemRecommendations->item as $item) 
	        {
	        // For each item node, build a link and append it to $retnc
	        $retnc .= "<td valign=\"bottom\"> \n";
	        $retnc .= "<div align=\"center\"> <!-- center align item details --> \n";
	        $retnc .= "<img src=\"$item->imageURL\"> \n";
	        $retnc .= "<p><a href=\"" . $item->viewItemURL . "\">" . $item->title . "</a></p> \n";
	        $retnc .= "</div></td> \n";
	        } // foreach
	        $retnc .= "</tr></table> \n<!-- finish table in getRelatedCategoryItemsResults --> \n";

	    } else {
	      // If there were errors, print an error
	      $retnc  = "The response contains errors<br>";
	      $retnc .= "Call used was: $apicallc";
	    }  // if errors

	    } else {
	      // If there was no response, print an error
	      $retnc = "Dang! Must not have got the getRelatedCategoryItems response! <br> $apicallc";
	    }  // if $resp
	  
	    return $retnc;
	  
	  }  // End of getRelatedCategoryItemsResults function


	  // Make returned eBay times pretty
	private static function getPrettyTimeFromEbayTime($eBayTimeString){
	    // Input is of form 'PT12M25S'
	    $matchAry = array(); // null out array which will be filled
	    $pattern = "#P([0-9]{0,3}D)?T([0-9]?[0-9]H)?([0-9]?[0-9]M)?([0-9]?[0-9]S)#msiU";
	    preg_match($pattern, $eBayTimeString, $matchAry);
	    
	    $days = 0;
	    if(isset($matchAry[1])) $days  = (int) $matchAry[1];
	    $hours = 0;
	    if(isset($matchAry[2])) $hours = (int) $matchAry[2];
	    $min = 0;
	    if(isset($matchAry[3])) $min   = (int) $matchAry[3];  // $matchAry[3] is of form 55M - cast to int 
	    $sec = 0;
	    if(isset($matchAry[4])) $sec   = (int) $matchAry[4];
	    
	    $retnStr = '';
	    if ($days)  { $retnStr .= " $days day"   . self::pluralS($days);  }
	    if ($hours) { $retnStr .= " $hours hour" . self::pluralS($hours); }
	    if ($min)   { $retnStr .= " $min minute" . self::pluralS($min);   }
	    if ($sec)   { $retnStr .= " $sec second" . self::pluralS($sec);   }
	    
	    return $retnStr;
	  } // function

	private static function pluralS($intIn) {
	    // if $intIn > 1 return an 's', else return null string
	    if ($intIn > 1) {
	      return 's';
	    } else {
	      return '';
	    }
	} // function

	  

}
