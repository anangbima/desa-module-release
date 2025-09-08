<?php

namespace Modules\DesaModuleRelease\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\DesaModuleRelease\Http\Controllers\Controller;
use Modules\DesaModuleRelease\Services\Admin\LogActivityService;

class LogActivityUserController extends Controller
{
    public function __construct(
        protected LogActivityService $logActivityService
    ) {}
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logs = $this->logActivityService->getAllLogsByUser(Auth::guard(desa_module_release_meta('snake').'_web')->user()->id);

        $data = [
            'title' => 'My Log Activity',
            'breadcrumbs' => [
                [
                    'name' => 'Dashboard',
                    'url' => route(desa_module_release_meta('kebab').'.admin.index'),
                ],
                [
                    'name' => 'My Log Activity',
                    'url' => '#',
                ],
            ],
            'logs' => $logs
        ];

        return view(desa_module_release_meta('kebab').'::web.admin.log-activity.user.index', $data);
    }

}
