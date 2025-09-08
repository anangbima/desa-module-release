<?php

namespace Modules\DesaModuleRelease\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasUlids;
    
    protected $connection;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->connection = config('desa_module_release.database.database_connection', 'desa_module_release');
        $this->table = config('desa_module_release.database.permission_table_prefix', 'desa_module_release_') . 'roles';
    }
}
