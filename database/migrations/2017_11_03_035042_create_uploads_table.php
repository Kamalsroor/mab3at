<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('module')->nullable();
            $table->bigInteger('module_id')->nullable();
            $table->uuid('upload_token')->nullable();
            $table->string('user_filename')->nullable();
            $table->string('filename')->nullable();
            $table->boolean('is_temp_delete')->default(0);
            $table->boolean('status')->default(0);
            $table->softDeletes(); 
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
        Schema::dropIfExists('uploads');
    }
}
