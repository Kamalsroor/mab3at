<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePurchasesBillsDetailSrialsTable extends Migration
{

    public function up()
    {
        Schema::create('purchases_bills_detail_Srials', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchases_bill_detail_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('srialnumper')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('purchases_bills_detail_Srials');
    }
}
