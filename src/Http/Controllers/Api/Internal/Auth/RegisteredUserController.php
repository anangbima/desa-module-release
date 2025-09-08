<?php

namespace Modules\DesaModuleRelease\Http\Controllers\Api\Internal\Auth;

use Illuminate\Http\Request;
use Modules\DesaModuleRelease\Http\Controllers\Controller;
use Modules\DesaModuleRelease\Http\Requests\Api\Auth\RegisterRequest;
use Modules\DesaModuleRelease\Services\Auth\AuthenticationApiService;
use Modules\DesaModuleRelease\Services\Shared\ApiResponseService;

class RegisteredUserController extends Controller
{
    public function __construct(
        protected AuthenticationApiService $authService,
        protected ApiResponseService $apiResponseService
    ) {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterRequest $request)
    {
        $request->validated();

        $result = $this->authService->register($request);

        if ($result['status'] === 'error') {
            return $this->apiResponseService->error(
                $result['message'],
                $result['code'] ?? 400,
                $result['errors'] ?? null
            );
        }

        return $this->apiResponseService->success($result['data'], 
            $result['message'] ?? 'Registration successful', 
            $result['code'] ?? 200
        );
    }
}
