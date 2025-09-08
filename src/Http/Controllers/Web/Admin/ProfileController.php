<?php

namespace Modules\DesaModuleRelease\Http\Controllers\Web\Admin;

use DesaDigitalSupport\RegionManager\Services\RegionService;
use Modules\DesaModuleRelease\Http\Controllers\Controller;
use Modules\DesaModuleRelease\Http\Requests\Web\Shared\UpdateProfileRequest;
use Modules\DesaModuleRelease\Services\Shared\ProfileService;

class ProfileController extends Controller
{
    public function __construct(
        protected ProfileService $profileService,
        protected RegionService $regionService,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = desa_module_release_auth_user()->role;

        $data = [
            'title' => 'Profile',
            'user' => desa_module_release_auth_user(),
            'role' => $role,
            'breadcrumbs' => [
                [
                    'name' => 'Dashboard',
                    'url' => route(desa_module_release_meta('kebab').'.admin.index'),
                ],
                [
                    'name' => 'Profile',
                    'url' => '#',
                ],
            ],
        ];


        // return view(desa_module_release_meta('kebab') . '::web.admin.profile.index', $data);
        return view(desa_module_release_meta('kebab') . '::web.shared.profile.index', $data);
    }

    /**
     * Display form for edit profile.
     */
    public function edit()
    {
        $data = [
            'title' => 'Edit Profile',
            'user' => desa_module_release_auth_user(),
            'provinceOptions' => $this->regionService->getProvinces()->map(function ($province) {
                return [
                    'value' => $province->code,
                    'label' => $province->name,
                ];
            })->toArray(),
        ];
        // dd($data['provinceOptions']);

        return view(desa_module_release_meta('kebab') . '::web.admin.profile.edit', $data);
    }

    /**
     * Update the user's profile.
     */
    public function update(UpdateProfileRequest $request)
    {
        $user = desa_module_release_auth_user();

        $this->profileService->updateProfile($user->id, $request->all());

        return redirect()->route(desa_module_release_meta('kebab') . '.admin.profile.index')->with('success', 'Profile updated successfully.');
    }
}
