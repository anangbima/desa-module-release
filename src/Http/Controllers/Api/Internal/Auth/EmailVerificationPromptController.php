<?php

namespace Modules\DesaModuleRelease\Http\Controllers\Api\Internal\Auth;

use Illuminate\Http\Request;
use Modules\DesaModuleRelease\Http\Controllers\Controller;
use Modules\DesaModuleRelease\Services\Auth\AuthenticationApiService;
use Modules\DesaModuleRelease\Services\Shared\ApiResponseService;

class EmailVerificationPromptController extends Controller
{
    public function __construct(
        protected AuthenticationApiService $authService,
        protected ApiResponseService $apiResponseService
    ) {}

    /**
     * Show the email verification prompt.
     */
    public function __invoke(Request $request)
    {
        $user = $request->user(desa_module_release_meta('snake').'_api');

        if ($user && $user->hasVerifiedEmail()) {
            return $this->apiResponseService->success(
                null,
                'Email already verified',
                200
            );
        }

        return $this->apiResponseService->error(
            'Email verification required',
            403
        );
    }
}
