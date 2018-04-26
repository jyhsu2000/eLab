<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcademicEventCommitteeMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_event_committee_members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('committee_name')->comment('名稱');
            $table->string('date_range')->nullable()->comment('起迄年月');
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
        Schema::dropIfExists('academic_event_committee_members');
    }
}
