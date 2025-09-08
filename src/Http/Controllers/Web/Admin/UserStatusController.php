<?php

namespace Modules\DesaModuleRelease\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use Modules\DesaModuleRelease\Http\Controllers\Controller;
use Modules\DesaModuleRelease\Models\User;
use Modules\DesaModuleRelease\Services\Admin\UserService;

class UserStatusController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {} 

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user = $this->userService->getUserById($user->id);

        $data = [
            'user' => $user,
            'title' => 'Edit User Status',
        ];

        return view(desa_module_release_meta('kebab').'::web.admin.user.status.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Toggle user status
        $status = $request->boolean('status');
        $this->userService->toggleStatus($user->id, $status);

       return redirect()->route(desa_module_release_meta('kebab').'.admin.users.index')->with('success', 'User status updated successfully.');
    }
}
