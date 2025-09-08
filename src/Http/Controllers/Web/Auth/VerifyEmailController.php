<?php

namespace Modules\DesaModuleRelease\Http\Controllers\Web\Auth;

use Illuminate\Http\Request;
use Modules\DesaModuleRelease\Http\Controllers\Controller;
use Modules\DesaModuleRelease\Services\Auth\AuthenticationService;

class VerifyEmailController extends Controller
{
    public function __construct(
        protected AuthenticationService $authService,    
    ) {}
    
    /**
     * Handle the email verification request.
     */
    public function __invoke(Request $request)
    {
        $this->authService->verifyEmail($request->route('user'));

        return redirect()->route(desa_module_release_meta('kebab').'.login');
    }
}
