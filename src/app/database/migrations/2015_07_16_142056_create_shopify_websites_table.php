<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopifyWebsitesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shopify_sites', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('category');
			$table->string('site_address');
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
		Schema::drop('shopify_sites');
	}

}
