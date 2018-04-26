<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcademicEventJournalEditorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_event_journal_editors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('journal_name')->comment('期刊名稱');
            $table->string('date')->nullable()->comment('時間');
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
        Schema::dropIfExists('academic_event_journal_editors');
    }
}
