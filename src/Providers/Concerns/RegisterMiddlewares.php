<?php

namespace Modules\DesaModuleRelease\Providers\Concerns;

use Modules\DesaModuleRelease\Http\Middleware\CheckUserStatus;
use Modules\DesaModuleRelease\Http\Middleware\EnsureEmailIsVerified;
use Modules\DesaModuleRelease\Http\Middleware\EnsureRole;
use Modules\DesaModuleRelease\Http\Middleware\RedirectIfAuthenticated;
use Modules\DesaModuleRelease\Http\Middleware\VerifyApiClient;

trait RegisterMiddlewares
{
    protected function registerMiddlewares(): void
    {
        $router = app('router');

        $router->aliasMiddleware('desa_module_release.role', EnsureRole::class);
        $router->aliasMiddleware('desa_module_release.guest', RedirectIfAuthenticated::class);
        $router->aliasMiddleware('desa_module_release.verified', EnsureEmailIsVerified::class);
        $router->aliasMiddleware('desa_module_release.status', CheckUserStatus::class);
        $router->aliasMiddleware('desa_module_release.verify_api_client', VerifyApiClient::class);
    }
}
