<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class FavoritesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Favorite::create([
			     "user_id" => 1,
			     "keyword" => Str::random(32),
			]);
		}
	}

}