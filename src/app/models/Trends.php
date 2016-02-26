<?php

class Trends {
	public static function keywords()
	{
		return Cache::remember('keywords', 60, function()
		{
			return Trends::joinArrays(GoogleTrends::worldwide(), AlexaTrends::Topics());
		});
	}

	public static function products()
	{
		return Cache::remember('products', 60, function()
		{
			$amResponse = Amazon::BestSellers();
			foreach ($amResponse as $key => $row) {
				$amData[] = $row['title'];
			}
			return Trends::joinArrays(AlexaTrends::Products(), $amData);
		});
	}

	private static function joinArrays($array1, $array2)
	{
		$data1 	= self::createArray($array1);
		$data2 	= self::createArray($array2);

		return self::cleanArray(array_merge($data1, $data2));
	}

	private static function createArray($array)
	{
		$data = array();

		foreach ($array as $key => $row) {

			$row = ucwords($row);

			if ( !in_array($row, $data) )
			{
				$data[] = $row;		
			}
		}

		return $data;
	}

	private static function cleanArray($array)
	{
		return array_unique($array, SORT_STRING);
	}
}
