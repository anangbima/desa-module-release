<?php 

namespace Modules\DesaModuleRelease\Providers;

use Illuminate\Cache\CacheManager;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Modules\DesaModuleRelease\Providers\Concerns\BindRepositories;
use Modules\DesaModuleRelease\Providers\Concerns\ConfigureNotifications;
use Modules\DesaModuleRelease\Providers\Concerns\ConfigurePermissions;
use Modules\DesaModuleRelease\Providers\Concerns\ConfigureSession;
use Modules\DesaModuleRelease\Providers\Concerns\LoadAuthConfig;
use Modules\DesaModuleRelease\Providers\Concerns\LoadDatabaseConfig;
use Modules\DesaModuleRelease\Providers\Concerns\LoadModelConfigs;
use Modules\DesaModuleRelease\Providers\Concerns\RegisterCommands;
use Modules\DesaModuleRelease\Providers\Concerns\RegisterHelpers;
use Modules\DesaModuleRelease\Providers\Concerns\RegisterMiddlewares;
use Modules\DesaModuleRelease\Services\Shared\PermissionRegistrar;

class ModuleServiceProvider extends ServiceProvider
{
    use RegisterCommands, 
        LoadDatabaseConfig, 
        LoadAuthConfig, 
        ConfigurePermissions, 
        BindRepositories, 
        LoadModelConfigs, 
        RegisterMiddlewares, 
        RegisterHelpers, 
        ConfigureSession,
        ConfigureNotifications;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Register meiddlewares
        $this->registerMiddlewares();

        // Load migrations from the module
        // Only load if the application is in the 'test' environment.
        // This is useful for module-specific migrations during automated testing,
        // so that the migrations don't affect other environments (like production or local).
        if (app()->environment('test')) {
            $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        }

        // load views from the module
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'desa-module-release');

        // register view components
        Blade::componentNamespace('Modules\\DesaModuleRelease\\View\\Components', 'desa-module-release');

        // load configure session
        $this->configureSession();

        // Configure notifications
        $this->configureNotifications();

        // Load permission and role spatie
        $this->configurePermissions();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Merge configuration files from the module
        $this->mergeConfigFrom(__DIR__ . '/../../config/general.php', 'desamodulerelease');
        
        // Register the route servie provider for this module
        $this->app->register(RouteServiceProvider::class);
        
        // Load the authentication configuration for this module
        $this->loadAuthConfig();
        
        // Register command for installing the module
        $this->registerModuleCommands();
        
        // load database only in test environmenr
        // if (app()->environment('test')) {
        //     $this->loadDatabaseConfig();
        // }

        $this->loadDatabaseConfig();
        
        // Binding Repository
        $this->bindRepositories();

        // load upload config
        $this->loadModelConfigs();

        // load helper
        $this->registerHelpers();

        $this->app->singleton(PermissionRegistrar::class, function ($app) {
            return new PermissionRegistrar(
                $app->make(CacheManager::class),
                $app->make(Dispatcher::class)
            );
        });
    }
}