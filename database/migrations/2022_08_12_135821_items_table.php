<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ItemsTable extends Migration {
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {
		Schema::create('items', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name', 80);
			$table->string('description', 255);
			$table->unsignedInteger('price');
			$table->unsignedInteger('inventory');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down() {
		Schema::dropIfExists('items');
	}
}
