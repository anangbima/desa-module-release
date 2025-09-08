<?php

namespace Modules\DesaModuleRelease\Http\Controllers\Web\Auth;

use Illuminate\Http\Request;
use Modules\DesaModuleRelease\Http\Controllers\Controller;
use Modules\DesaModuleRelease\Services\Auth\AuthenticationService;

class EmailVerificationNotificationController extends Controller
{
    public function __construct(
        protected AuthenticationService $authService,    
    ) {}
    
    /**
     * Handle the email verification notification request.
     */
    public function store(Request $request)
    {
        $this->authService->resendEmailVerification($request);

        // Optionally, you can redirect or return a response
        return back()->with('status', 'verification-link-sent');
    }
}
