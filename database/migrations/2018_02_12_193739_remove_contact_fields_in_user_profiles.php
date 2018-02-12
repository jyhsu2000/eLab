<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RemoveContactFieldsInUserProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('office_phone');
            $table->dropColumn('home_phone');
            $table->dropColumn('cell_phone');
            $table->dropColumn('link');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->string('email')->nullable()->comment('聯絡信箱');
            $table->string('office_phone')->nullable()->comment('工作電話');
            $table->string('home_phone')->nullable()->comment('家裡電話');
            $table->string('cell_phone')->nullable()->comment('手機');
            $table->string('link')->nullable()->comment('個人網址');
        });
    }
}
