<?php

namespace Modules\DesaModuleRelease\Providers\Concerns;

use Modules\DesaModuleRelease\Models\Permission;
use Modules\DesaModuleRelease\Models\Role;

trait ConfigurePermissions
{
    protected function configurePermissions(): void
    {
        $prefix = 'desa_module_release_';
        $connection = 'desa_module_release';

        config([
            'permission.models.role' => Role::class,
            'permission.models.permission' => Permission::class,
            'permission.table_names.roles' => $prefix . 'roles',
            'permission.table_names.permissions' => $prefix . 'permissions',
            'permission.table_names.model_has_roles' => $prefix . 'model_has_roles',
            'permission.table_names.model_has_permissions' => $prefix . 'model_has_permissions',
            'permission.table_names.role_has_permissions' => $prefix . 'role_has_permissions',
            'permission.connection' => $connection,
        ]);
    }
}
