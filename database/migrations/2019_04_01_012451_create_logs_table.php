<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::create('logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('register_id');
            $table->string('qrcode');
            $table->string('name');
            $table->string('log_in');
            $table->string('log_out')->nullable();
            $table->string('late')->nullable();
            $table->string('under')->nullable();
            $table->integer('status');
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
        Schema::enableForeignKeyConstraints();
        Schema::dropIfExists('logs');
    }
}
