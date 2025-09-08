<?php

namespace Modules\DesaModuleRelease\Http\Controllers\Web\Auth;

use Illuminate\Http\Request;
use Modules\DesaModuleRelease\Http\Controllers\Controller;
use Modules\DesaModuleRelease\Http\Requests\Web\Auth\ConfirmablePasswordRequest;
use Modules\DesaModuleRelease\Services\Auth\AuthenticationService;

class ConfirmablePasswordController extends Controller
{
    public function __construct(
        protected AuthenticationService $authService,    
    ) {}

    /**
     * Display the confirmable password form.
     */
    public function create()
    {
        $data = [
            'title' => 'Confirm Password',
        ];

        return view(desa_module_release_meta('kebab').'::web.auth.confirm-password', $data);
    }

    /**
     * Handle the confirmable password request.
     */
    public function store(ConfirmablePasswordRequest $request)
    {
        $request->validated();
        $this->authService->confirmPassword($request->password);

        return redirect()->intended();
    }
    
}
