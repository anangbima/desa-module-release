<?php

namespace Modules\DesaModuleRelease\Http\Controllers\Api\External;

use Illuminate\Http\Request;
use Modules\DesaModuleRelease\Http\Controllers\Controller;
use Modules\DesaModuleRelease\Http\Resources\Admin\UserResource;
use Modules\DesaModuleRelease\Services\Admin\UserService;
use Modules\DesaModuleRelease\Services\Shared\ApiResponseService;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService, // temporary
        protected ApiResponseService $apiResponseService,
    ) {}
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->userService->getAllUser();

        return $this->apiResponseService->success(UserResource::collection($users), 'Users retrieved successfully.');
    }

}
