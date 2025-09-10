<?php

namespace Modules\DesaModuleRelease\Http\Controllers\Web\Guest;

use Illuminate\Http\Request;
use Modules\DesaModuleRelease\Http\Controllers\Controller;
use Modules\DesaModuleRelease\Models\Permission;
use Modules\DesaModuleRelease\Services\Shared\PermissionRegistrar;

class HomeController extends Controller
{   
    /**
     * Display a listing of the resource.
     */
    public function index(PermissionRegistrar $registrar)
    {   
        $data = [
            'title' => 'Dashboard',
            'breadcrumbs' => [
                [
                    'name' => 'Dashboard',
                    'url' => route(desa_module_release_meta('kebab').'.index'),
                ],
                [
                    'name' => 'Home',
                    'url' => '#',
                ],
            ],
        ];

        return view(desa_module_release_meta('kebab').'::web.guest.home.index', $data);
    }
}
