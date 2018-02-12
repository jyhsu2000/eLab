<?php

use Illuminate\Database\Migrations\Migration;

class CreateContactTypeData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\ContactType::create([
            'name'       => '聯絡信箱',
            'icon_class' => 'fa fa-fw fa-envelope',
            'is_url'     => false,
        ]);
        \App\ContactType::create([
            'name'       => '工作電話',
            'icon_class' => 'fa fa-fw fa-phone',
            'is_url'     => false,
        ]);
        \App\ContactType::create([
            'name'       => '家裡電話',
            'icon_class' => 'fa fa-fw fa-home',
            'is_url'     => false,
        ]);
        \App\ContactType::create([
            'name'       => '手機',
            'icon_class' => 'fa fa-fw fa-mobile',
            'is_url'     => false,
        ]);
        \App\ContactType::create([
            'name'       => '個人網址',
            'icon_class' => 'fa fa-fw fa-link',
            'is_url'     => true,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \App\ContactType::whereName('聯絡信箱')->delete();
        \App\ContactType::whereName('工作電話')->delete();
        \App\ContactType::whereName('家裡電話')->delete();
        \App\ContactType::whereName('手機')->delete();
        \App\ContactType::whereName('個人網址')->delete();
    }
}
