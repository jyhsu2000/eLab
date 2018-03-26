<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable()->comment('使用者');
            $table->unsignedInteger('in_year')->nullable()->comment('入學年度');
            $table->unsignedInteger('graduate_year')->nullable()->comment('畢業年度');
            $table->boolean('in_school')->default(false)->comment('在學中');
            $table->string('type')->nullable()->comment('身分');
            $table->string('name')->nullable()->comment('姓名');
            $table->string('nickname')->nullable()->comment('暱稱');
            $table->string('email')->nullable()->comment('聯絡信箱');
            $table->string('office_phone')->nullable()->comment('工作電話');
            $table->string('home_phone')->nullable()->comment('家裡電話');
            $table->string('cell_phone')->nullable()->comment('手機');
            $table->string('link')->nullable()->comment('個人網址');
            $table->text('info')->nullable()->comment('個人簡介');
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
        Schema::dropIfExists('user_profiles');
    }
}
