<?php

namespace Modules\DesaModuleRelease\View\Components;

use Illuminate\View\Component;

class LogActivityTable extends Component
{
    public $logs;
    public $role;

    public function __construct($logs, $role = null)
    {
        $this->logs = $logs;
        $this->role = $this->role = $role ?? desa_module_release_auth_user()?->role;
    }
    
    public function render()
    {
        return view(desa_module_release_meta('kebab').'::components.log-activity-table');
    }
}