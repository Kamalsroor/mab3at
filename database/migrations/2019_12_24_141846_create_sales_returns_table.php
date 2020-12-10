<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSalesReturnsTable extends Migration
{

    public function up()
    {
        Schema::create('sales_returns', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('branch_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('customer_id')->unsigned()->nullable();
            $table->longText('note')->nullable();
            $table->string('img')->nullable();
            $table->decimal('amount', 8, 2)->nullable();
            $table->dateTime('date_at');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('sales_returns');
    }
}
