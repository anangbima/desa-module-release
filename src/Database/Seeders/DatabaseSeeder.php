<?php

namespace Modules\DesaModuleRelease\Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            UserSeeder::class,
            SettingSeeder::class,
            NotificationSeeder::class
        ]);
    }
}
