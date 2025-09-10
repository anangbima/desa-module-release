<?php

namespace Modules\DesaModuleRelease\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    use HasUlids;

    public function getConnectionName()
    {
        return config('desamodulerelease.permission.connection', 'desa_module_release');
    }

    public function getTable()
    {
        return config('desamodulerelease.permission.table_names.permissions', 'desa_module_release_permissions');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            Role::class,
            config('desamodulerelease.permission.table_names.role_has_permissions', 'desa_module_release_role_has_permissions'),
            'permission_id',
            'role_id'
        );
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            config('desamodulerelease.permission.table_names.model_has_permissions', 'desa_module_release_model_has_permissions'),
            'permission_id',
            'model_id'
        )->withPivot('model_type');
    }
}
