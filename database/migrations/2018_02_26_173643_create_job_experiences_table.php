<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_experiences', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_profile_id')->comment('個人資料');
            $table->string('content')->comment('內容');
            $table->boolean('is_public')->comment('公開顯示');
            $table->integer('start_year')->nullable()->comment('開始年');
            $table->integer('start_month')->nullable()->comment('開始月');
            $table->integer('start_day')->nullable()->comment('開始日');
            $table->integer('end_year')->nullable()->comment('結束年');
            $table->integer('end_month')->nullable()->comment('結束月');
            $table->integer('end_day')->nullable()->comment('結束日');
            $table->timestamps();

            $table->foreign('user_profile_id')->references('id')->on('user_profiles')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_experiences');
    }
}
