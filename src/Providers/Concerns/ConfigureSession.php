<?php

namespace Modules\DesaModuleRelease\Providers\Concerns;

use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Session;
use Modules\DesaModuleRelease\Session\ModuleSessionHandler;

trait ConfigureSession
{
    protected function configureSession()
    {
        $this->app->resolving(SessionManager::class, function ($sessionManager) {
            config([
                'session.driver'     => env('DESA_MODULE_RELEASE_SESSION_DRIVER', 'database'),
                'session.connection' => env('DESA_MODULE_RELEASE_SESSION_CONNECTION', 'desa_module_release'),
                'session.table'      => env('DESA_MODULE_RELEASE_SESSION_TABLE', 'desa_module_release_sessions'),
                'session.cookie'     => env('DESA_MODULE_RELEASE_SESSION_COOKIE', 'desa_module_release_session'),
            ]);
        });
        
        // Register driver session custom
        Session::extend('module_database', function ($app) {
            $connection = $app['db']->connection(config('session.connection'));
            $table      = config('session.table');
            $lifetime   = config('session.lifetime');

            return new ModuleSessionHandler($connection, $table, $lifetime, $app);
        });
    }

    // protected function configureSession()
    // {
    //     config([
    //         'session.driver'     => env('DESA_MODULE_RELEASE_SESSION_DRIVER', 'module_database'),
    //         'session.connection' => env('DESA_MODULE_RELEASE_SESSION_CONNECTION', 'desa_module_release'),
    //         'session.table'      => env('DESA_MODULE_RELEASE_SESSION_TABLE', 'desa_module_release_sessions'),
    //         'session.cookie'     => env('DESA_MODULE_RELEASE_SESSION_COOKIE', 'desa_module_release_session'),
    //     ]);

    //     $this->app['session']->extend('module_database', function ($app) {
    //         $connection = $app['db']->connection(config('session.connection'));
    //         $table      = config('session.table');
    //         $lifetime   = config('session.lifetime');

    //         return new \Modules\DesaModuleRelease\Session\ModuleSessionHandler(
    //             $connection, $table, $lifetime, $app
    //         );
    //     });
    // }
}
