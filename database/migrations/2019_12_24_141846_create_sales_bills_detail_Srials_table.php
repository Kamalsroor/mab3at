<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSalesBillsDetailSrialsTable extends Migration
{

    public function up()
    {
        Schema::create('sales_bills_detail_Srials', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sales_bill_detail_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('srialnumper')->nullable();
            $table->softDeletes(); 
$table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('sales_bills_detail_Srials');
    }
}
