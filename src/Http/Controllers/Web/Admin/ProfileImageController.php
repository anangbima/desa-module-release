<?php

namespace Modules\DesaModuleRelease\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use Modules\DesaModuleRelease\Http\Controllers\Controller;
use Modules\DesaModuleRelease\Http\Requests\Web\Shared\UpdateProfileImageRequest;
use Modules\DesaModuleRelease\Services\Admin\ProfileService;

class ProfileImageController extends Controller
{
    public function __construct(
        protected ProfileService $profileService
    ) {}
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $data = [
            'title' => 'Change Profile Image',
            'user' => desa_module_release_auth_user(),
        ];

        return view(desa_module_release_meta('kebab').'::web.admin.profile.image.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileImageRequest $request)
    {
        $this->profileService->updateProfileImage($request->file('image'));

        return redirect()->route(desa_module_release_meta('kebab').'.admin.profile.index')
            ->with('success', 'Profile image updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        $this->profileService->removeProfileImage();

        return redirect()->route(desa_module_release_meta('kebab').'.admin.profile.index')
            ->with('success', 'Profile image removed successfully.');
    }
}
