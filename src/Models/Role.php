<?php

namespace Modules\DesaModuleTemplate\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasUlids;
    
    protected $connection;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->connection = config('desa_module_template.database.database_connection', 'desa_module_template');
        $this->table = config('desa_module_template.database.permission_table_prefix', 'desa_module_template_') . 'roles';
    }
}
