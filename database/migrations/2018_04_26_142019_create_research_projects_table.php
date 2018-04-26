<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResearchProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research_projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('計畫名稱');
            $table->string('job')->nullable()->comment('擔任工作');
            $table->string('date_range')->nullable()->comment('起迄年月');
            $table->string('subsidy_agency')->nullable()->comment('補助機構');
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
        Schema::dropIfExists('research_projects');
    }
}
