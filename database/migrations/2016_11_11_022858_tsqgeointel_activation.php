<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TsqgeointelActivation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tsqgeointel_activation', function(Blueprint $table)
		{
			$table->increments('act_id');
			$table->string('act_code', 15);
			$table->string('organization', 50);
			$table->tinyInteger('status');
			$table->string('device_code', 30);
			$table->string('project', 50);
			$table->timestamp('act_date');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tsqgeointel_activation');
	}

}
