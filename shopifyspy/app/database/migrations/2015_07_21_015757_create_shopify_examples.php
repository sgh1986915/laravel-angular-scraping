<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopifyExamples extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shopify_examples', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('category');
			$table->string('website_address');
			$table->string('ip_address');
			$table->string('ip_range');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('shopify_examples');
	}

}
