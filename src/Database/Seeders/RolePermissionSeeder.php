<?php

namespace Modules\DesaModuleRelease\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\DesaModuleRelease\Models\Permission;
use Modules\DesaModuleRelease\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Roles
        $roles = ['admin', 'user'];

        foreach ($roles as $roleName) {
            Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'desa_module_release_web',
            ]);
        }

        $permissions = collect([
            ['name' => 'user create', 'module_name' => 'user'],
            ['name' => 'user update', 'module_name' => 'user'],
            ['name' => 'user delete', 'module_name' => 'user'],
            ['name' => 'user show', 'module_name' => 'user'],
            ['name' => 'user index', 'module_name' => 'user'],

            ['name' => 'permission index', 'module_name' => 'permission'],
            ['name' => 'permission create', 'module_name' => 'permission'],
            ['name' => 'permission update', 'module_name' => 'permission'],
            ['name' => 'permission delete', 'module_name' => 'permission'],
            ['name' => 'permission show', 'module_name' => 'permission'],

            ['name' => 'role index', 'module_name' => 'role'],
            ['name' => 'role create', 'module_name' => 'role'],
            ['name' => 'role update', 'module_name' => 'role'],
            ['name' => 'role delete', 'module_name' => 'role'],
            ['name' => 'role show', 'module_name' => 'role'],
        ]);

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission['name'],
                'guard_name' => 'desa_module_release_web',
            ], [
                'module_name' => $permission['module_name'],
            ]);
        }

        $admin = Role::where('name', 'admin')->first();
        if ($admin) {
            $allPermissions = Permission::pluck('name')->toArray();
            $admin->syncPermissions($allPermissions);
        }
    }
}
