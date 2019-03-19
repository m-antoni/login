<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first');
            $table->string('last');
            $table->string('middle')->nullable();
            $table->string('gender');
            $table->string('birthday');
            $table->string('contact');
            $table->string('email');
            $table->string('address');
            $table->bigInteger('department');
            $table->string('date_hired');
            $table->string('user_type');
            $table->string('id_number');
            $table->string('password');
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
        Schema::dropIfExists('registers');
    }
}
