<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Migrations\Migration;

class CreateLabMemberBypassPermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $perm = Permission::create([
            'name'         => 'lab-member.bypass',
            'display_name' => '進入限實驗室成員進入之區域',
            'description'  => '不受限制進入限實驗室成員進入之區域',
        ]);

        /* @var Role $admin */
        $admin = Role::where('name', 'Admin')->first();
        $admin->attachPermission($perm);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Permission::whereName('lab-member.bypass')->delete();
    }
}
