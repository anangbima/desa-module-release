<?php

namespace Modules\DesaModuleRelease\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\DesaModuleRelease\Models\User;
use Modules\DesaModuleRelease\Models\Media;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'slug' => 'admin-user',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('admin');

        // // Tambahkan dummy foto profil untuk admin
        // $admin->media()->create([
        //     'name' => 'admin-profile.jpg',
        //     'path' => 'dummy/admin-profile.jpg',
        //     'type' => 'image/jpeg',
        //     'size' => 123456,
        //     'disk' => 'public',
        //     'collection' => 'profile',
        //     'usage' => 'profile',
        // ]);

        // Create user
        User::factory()->count(10)->create()->each(function ($user) {
            $user->assignRole('user');
        });
    }
}
