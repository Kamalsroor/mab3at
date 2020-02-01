<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSalesReturnsDetailsTable extends Migration
{

    public function up()
    {
        Schema::create('sales_returns_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sales_return_id')->unsigned()->nullable();
            $table->integer('sales_bills_detail_Srial_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('product_id')->unsigned()->nullable();
            $table->decimal('amount', 8, 2)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('sales_returns_details');
    }
}
