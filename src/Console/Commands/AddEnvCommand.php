<?php

namespace Modules\DesaModuleRelease\Console\Commands;

use Illuminate\Console\Command;

class AddEnvCommand extends Command
{
    protected $signature;
    protected $description = 'Add environment variables for Desa Module Release';

    public function __construct()
    {
        $this->signature = 'module:desamodulerelease:add-env';
        parent::__construct();
    }
    
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $envVariables = [
            'DESA_MODULE_RELEASE_ENABLED' => 'true',
            'DESA_MODULE_RELEASE_NAME' => 'Desa Module Release',
            'DESA_MODULE_RELEASE_SLUG' => 'desa-module-release',
            'DESA_MODULE_RELEASE_PREFIX' => 'desa-module-release',
            'DESA_MODULE_RELEASE_DB_DRIVER' => 'mysql',
            'DESA_MODULE_RELEASE_DB_CONNECTION' => 'desa_module_release',
            'DESA_MODULE_RELEASE_DB_HOST' => '127.0.0.1',
            'DESA_MODULE_RELEASE_DB_PORT' => '3306',
            'DESA_MODULE_RELEASE_DB_DATABASE' => 'desa_module_release',
            'DESA_MODULE_RELEASE_DB_USERNAME' => 'root',
            'DESA_MODULE_RELEASE_DB_PASSWORD' => '',
            'DESA_MODULE_RELEASE_DOMAIN' => 'desamodulerelease.test',
            'DESA_MODULE_RELEASE_SESSION_DRIVER' => 'database',
            'DESA_MODULE_RELEASE_SESSION_CONNECTION' => 'desa_module_release',
            'DESA_MODULE_RELEASE_SESSION_TABLE' => 'desa_module_release_sessions',
            'DESA_MODULE_RELEASE_SESSION_COOKIE' => 'desa_module_release_session',
            ''
        ];

        $envPath = base_path('.env');

        if (!file_exists($envPath)) {
            $this->error('.env file not found at: ' . $envPath);
            return 1;
        }

        $envContent = file_get_contents($envPath);

        foreach ($envVariables as $key => $value) {
            if (strpos($envContent, $key) === false) {
                // Escape nilai yang mengandung spasi atau karakter khusus
                if (preg_match('/\s/', $value)) {
                    $value = '"' . addslashes($value) . '"';
                }

                $envContent .= "\n{$key}={$value}";
                $this->line("Added {$key} to .env");
            } else {
                $this->info("{$key} already exists in .env");
            }
        }

        file_put_contents($envPath, $envContent);

        return 0;
    }
}