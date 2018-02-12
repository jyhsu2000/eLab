<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_profile_id')->comment('個人資料');
            $table->unsignedInteger('contact_type_id')->comment('聯絡資料類型');
            $table->string('content')->comment('內容');
            $table->boolean('is_public')->comment('公開顯示');
            $table->timestamps();

            $table->foreign('user_profile_id')->references('id')->on('user_profiles')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('contact_type_id')->references('id')->on('contact_types')
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
        Schema::dropIfExists('contact_infos');
    }
}
