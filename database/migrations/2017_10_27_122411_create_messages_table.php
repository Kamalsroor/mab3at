<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->nullable();
            $table->boolean('is_draft')->default(0);
            $table->bigInteger('from_user_id')->unsigned();
            $table->bigInteger('to_user_id')->unsigned()->nullable();
            $table->string('subject')->nullable();
            $table->text('body')->nullable();
            $table->boolean('is_important_by_sender')->default(0);
            $table->boolean('is_important_by_receiver')->default(0);
            $table->boolean('is_read')->default(0);
            $table->boolean('is_deleted_by_sender')->default(0);
            $table->boolean('is_deleted_by_receiver')->default(0);
            $table->bigInteger('reply_id')->unsigned()->nullable();
            $table->boolean('has_attachment')->default(0);
            $table->string('upload_token')->null();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
