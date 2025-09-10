<?php

namespace Modules\DesaModuleRelease\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasUlids;
    
    public function getConnectionName()
    {
        return config('desamodulerelease.permission.connection', 'desa_module_release');
    }

    public function getTable()
    {
        return config('desamodulerelease.permission.table_names.roles', 'desa_module_release_roles');
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            Permission::class,
            config('desamodulerelease.permission.table_names.role_has_permissions', 'desa_module_release_role_has_permissions'),
            'role_id',
            'permission_id'
        );
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            config('desamodulerelease.permission.table_names.model_has_roles', 'desa_module_release_model_has_roles'),
            'role_id',
            'model_id'
        )->withPivot('model_type');
    }

}
