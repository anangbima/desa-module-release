<?php

namespace Modules\DesaModuleRelease\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use Modules\DesaModuleRelease\Http\Controllers\Controller;
use Modules\DesaModuleRelease\Services\Admin\SettingService;

class SettingController extends Controller
{
    public function __construct(
        protected SettingService $settingService
    ) {}
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'General Setting',
            'breadcrumbs' => [
                [
                    'name' => 'Dashboard',
                    'url' => route(desa_module_release_meta('kebab').'.admin.index'),
                ],
                [
                    'name' => 'General Setting',
                    'url' => '#',
                ],
            ],
            'settings' => $this->settingService->getAllSetting(),
        ];

        return view(desa_module_release_meta('kebab').'::web.admin.setting.index', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $this->settingService->updateAllSettings($request);

        return redirect()->route(desa_module_release_meta('kebab').'.admin.settings.index')
            ->with('success', 'Settings updated successfully.');
    }
}
