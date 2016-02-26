<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWebsitesFields extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('websites', function(Blueprint $table)
		{
			$table->integer('traffic_volume')->nullable();
			$table->integer('global_rank')->nullable();
			$table->decimal('global_traffic', 15, 15)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
