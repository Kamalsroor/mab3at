<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePurchasesBillsDetailsTable extends Migration
{

	public function up()
	{
		Schema::create('purchases_bills_details', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('purchases_bill_id')->unsigned()->nullable();
			$table->integer('user_id')->unsigned()->nullable();
			$table->integer('product_id')->unsigned()->nullable();
			// $table->longText('note')->nullable();
			// $table->string('img')->nullable();
			$table->decimal('amount', 8, 2)->nullable();
			// $table->dateTime('date_at');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('purchases_bills_details');
	}
}
