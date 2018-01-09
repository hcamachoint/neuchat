<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFilesTable extends Migration {

	public function up()
	{
		Schema::create('files', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 200);
			$table->string('type', 20);
			$table->string('url', 200);
			$table->integer('fileable_id');
			$table->string('fileable_type');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('files');
	}
}