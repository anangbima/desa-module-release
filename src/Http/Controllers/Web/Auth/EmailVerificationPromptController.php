<?php

namespace Modules\DesaModuleRelease\Http\Controllers\Web\Auth;

use Illuminate\Http\Request;
use Modules\DesaModuleRelease\Http\Controllers\Controller;
use Modules\DesaModuleRelease\Services\Auth\AuthenticationService;

class EmailVerificationPromptController extends Controller
{
    public function __construct(
        protected AuthenticationService $authService,    
    ) {}
    
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request)
    {
        return $request->user(desa_module_release_meta('snake').'_web')?->hasVerifiedEmail()
            ? redirect()->intended()
            : view(desa_module_release_meta('kebab').'::web.auth.verify-email');
    }
    
}
