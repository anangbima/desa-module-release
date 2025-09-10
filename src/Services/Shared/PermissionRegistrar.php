<?php

namespace Modules\DesaModuleRelease\Services\Shared;

use Modules\DesaModuleRelease\Models\Permission;
use Modules\DesaModuleRelease\Models\Role;
use Spatie\Permission\PermissionRegistrar as SpatiePermissionRegistrar;

class PermissionRegistrar extends SpatiePermissionRegistrar
{
    public function getPermissionClass(): string
    {
        return Permission::class;
    }

    public function getRoleClass(): string
    {
        return Role::class;
    }
}