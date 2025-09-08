<?php

namespace Modules\DesaModuleRelease\Providers\Concerns;

trait BindRepositories
{
    protected function bindRepositories(): void
    {
        $this->app->bind(\Modules\DesaModuleRelease\Repositories\Interfaces\SettingRepositoryInterface::class, \Modules\DesaModuleRelease\Repositories\SettingRepository::class);
        $this->app->bind(\Modules\DesaModuleRelease\Repositories\Interfaces\MediaUsageRepositoryInterface::class, \Modules\DesaModuleRelease\Repositories\MediaUsageRepository::class);
        $this->app->bind(\Modules\DesaModuleRelease\Repositories\Interfaces\MediaRepositoryInterface::class, \Modules\DesaModuleRelease\Repositories\MediaRepository::class);
        $this->app->bind(\Modules\DesaModuleRelease\Repositories\Interfaces\ApiClientRepositoryInterface::class, \Modules\DesaModuleRelease\Repositories\ApiClientRepository::class);
        $this->app->bind(\Modules\DesaModuleRelease\Repositories\Interfaces\PermissionRepositoryInterface::class, \Modules\DesaModuleRelease\Repositories\PermissionRepository::class);
        $this->app->bind(\Modules\DesaModuleRelease\Repositories\Interfaces\RoleRepositoryInterface::class, \Modules\DesaModuleRelease\Repositories\RoleRepository::class);
        $this->app->bind(\Modules\DesaModuleRelease\Repositories\Interfaces\UserRepositoryInterface::class, \Modules\DesaModuleRelease\Repositories\UserRepository::class);
        $this->app->bind(\Modules\DesaModuleRelease\Repositories\Interfaces\LogActivityRepositoryInterface::class, \Modules\DesaModuleRelease\Repositories\LogActivityRepository::class);
        
    }
}