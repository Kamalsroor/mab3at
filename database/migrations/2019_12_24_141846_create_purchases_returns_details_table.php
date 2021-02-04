<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePurchasesReturnsDetailsTable extends Migration
{

    public function up()
    {
        Schema::create('purchases_returns_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchases_return_id')->unsigned()->nullable();
            $table->integer('purchases_bills_detail_Srial_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('product_id')->unsigned()->nullable();
            $table->decimal('amount', 8, 2)->nullable();
            $table->softDeletes(); 
$table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('purchases_returns_details');
    }
}
