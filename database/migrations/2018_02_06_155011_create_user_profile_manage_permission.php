<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfileManagePermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $perm = Permission::create([
            'name'         => 'user-profile.manage',
            'display_name' => '管理成員',
            'description'  => '管理成員資料',
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
        Permission::whereName('user-profile.manage')->delete();
    }
}
