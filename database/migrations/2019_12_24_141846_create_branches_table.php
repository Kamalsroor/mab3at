<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBranchesTable extends Migration {

	public function up()
	{
		Schema::create('branches', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name')->unique()->nullable();
			$table->integer('user_id')->unsigned()->nullable();
			$table->mediumText('address')->nullable();
			$table->string('phone')->nullable();
			$table->string('telephone')->nullable();
			$table->softDeletes(); 
$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('branches');
	}
}