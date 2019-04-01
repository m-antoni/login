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
            $table->string('name');
            $table->string('id_number');
            $table->string('time_in');
            $table->string('time_out');
            $table->string('hours');
            $table->string('date');
            $table->string('late');
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
