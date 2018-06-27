<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcademicSpeechesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_speeches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('演講題目');
            $table->string('location')->nullable()->comment('地點');
            $table->string('date')->nullable()->comment('日期');
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
        Schema::dropIfExists('academic_speeches');
    }
}
