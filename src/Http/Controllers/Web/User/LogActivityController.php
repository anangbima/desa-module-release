<?php

namespace Modules\DesaModuleRelease\Http\Controllers\Web\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\DesaModuleRelease\Http\Controllers\Controller;
use Modules\DesaModuleRelease\Models\LogActivity;
use Modules\DesaModuleRelease\Services\User\LogActivityService;

class LogActivityController extends Controller
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
            'logs' => $logs,
            'title' => 'Log Activity',
             'breadcrumbs' => [
                [
                    'name' => 'Dashboard',
                    'url' => route(desa_module_release_meta('kebab').'.user.index'),
                ],
                [
                    'name' => 'Log Activity',
                    'url' => '#',
                ],
            ],
        ];

        return view(desa_module_release_meta('kebab').'::.web.user.log-activity.index', $data);
    }

    /**
     * Display the specified resource.
     */
    public function show(LogActivity $log)
    {
        $logActivity = $this->logActivityService->getLogById($log->id);

        $data = [
            'log' => $logActivity,
            'title' => 'Log Activity Detail',
            'breadcrumbs' => [
                [
                    'name' => 'Dashboard',
                    'url' => route(desa_module_release_meta('kebab').'.admin.index'),
                ],
                [
                    'name' => 'Log Activity Detail',
                    'url' => '#',
                ],
            ],
        ];

        return view(desa_module_release_meta('kebab').'::web.user.log-activity.show', $data);
    }   
}
