<?php

namespace Modules\DesaModuleRelease\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\DesaModuleRelease\Models\LogActivity;

class LogActivitySeeder extends Seeder
{
    public function run(): void
    {
        LogActivity::factory()->count(10)->create();
    }
}
