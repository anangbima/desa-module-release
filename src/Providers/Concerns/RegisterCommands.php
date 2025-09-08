<?php

namespace Modules\DesaModuleRelease\Providers\Concerns;

use Modules\DesaModuleRelease\Console\Commands\AddEnvCommand;
use Modules\DesaModuleRelease\Console\Commands\InstallCommand;
use Modules\DesaModuleRelease\Console\Commands\MakeComponentCommand;
use Modules\DesaModuleRelease\Console\Commands\MakeControllerCommand;
use Modules\DesaModuleRelease\Console\Commands\MakeExporterCommand;
use Modules\DesaModuleRelease\Console\Commands\MakeFactoryCommand;
use Modules\DesaModuleRelease\Console\Commands\MakeImporterCommand;
use Modules\DesaModuleRelease\Console\Commands\MakeMiddlewareCommand;
use Modules\DesaModuleRelease\Console\Commands\MakeModelCommand;
use Modules\DesaModuleRelease\Console\Commands\MakeNotificationCommand;
use Modules\DesaModuleRelease\Console\Commands\MakeRepositoryCommand;
use Modules\DesaModuleRelease\Console\Commands\MakeRepositoryInterfaceCommand;
use Modules\DesaModuleRelease\Console\Commands\MakeRequestCommand;
use Modules\DesaModuleRelease\Console\Commands\MakeResourceCommand;
use Modules\DesaModuleRelease\Console\Commands\MakeSeederCommand;
use Modules\DesaModuleRelease\Console\Commands\MakeServiceCommand;
use Modules\DesaModuleRelease\Console\Commands\MakeTraitCommand;
use Modules\DesaModuleRelease\Console\Commands\MigrateCommand;
use Modules\DesaModuleRelease\Console\Commands\RegisterProviderCommand;
use Modules\DesaModuleRelease\Console\Commands\RouteListCommand;
use Modules\DesaModuleRelease\Console\Commands\UpdateAutoloadCommand;

trait RegisterCommands
{
    protected function registerModuleCommands(): void
    {
        $this->commands([
            AddEnvCommand::class,
            InstallCommand::class,
            MigrateCommand::class,
            RegisterProviderCommand::class,
            UpdateAutoloadCommand::class,
            MakeControllerCommand::class,
            MakeModelCommand::class,
            MakeRequestCommand::class,
            MakeServiceCommand::class,
            MakeRepositoryCommand::class,
            MakeRepositoryInterfaceCommand::class,
            MakeSeederCommand::class,
            MakeFactoryCommand::class,
            MakeResourceCommand::class,
            MakeMiddlewareCommand::class,
            MakeNotificationCommand::class,
            RouteListCommand::class,
            MakeComponentCommand::class,
            MakeTraitCommand::class,
            MakeExporterCommand::class,
            MakeImporterCommand::class,
        ]);
    }
}
