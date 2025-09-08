<?php

namespace Modules\DesaModuleRelease\View\Components;

use Illuminate\View\Component;

class GuestLayout extends Component
{
    public function render()
    {
        return view(desa_module_release_meta('kebab').'::layouts.guest');
    }
}