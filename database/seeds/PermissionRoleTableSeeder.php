<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $admin_permissions = Permission::all();
        $admin_permissions->filter(function ($permission) {
            return $permission->title != 'priority_access' && $permission->title != 'user_management_access' && $permission->title != 'status_access' && $permission->title != 'category_access';
        });
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
        $user_permissions = $admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 7) == 'ticket_' && $permission->title != 'ticket_delete';
        });
        Role::findOrFail(2)->permissions()->sync($user_permissions);
    }
}
