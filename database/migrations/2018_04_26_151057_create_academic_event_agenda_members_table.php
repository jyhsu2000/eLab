<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcademicEventAgendaMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_event_agenda_members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('agenda_name')->comment('會議名稱');
            $table->string('date')->nullable()->comment('會議時間');
            $table->string('location')->nullable()->comment('會議地點');
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
        Schema::dropIfExists('academic_event_agenda_members');
    }
}
