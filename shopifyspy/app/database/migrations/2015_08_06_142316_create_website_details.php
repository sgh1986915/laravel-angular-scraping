<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsiteDetails extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('website_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('website_id');
			$table->text('website_tags')->nullable();
			$table->text('website_organic_keywords')->nullable();
			$table->text('website_paid_keywords')->nullable();
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
		Schema::drop('website_details');
	}

}
