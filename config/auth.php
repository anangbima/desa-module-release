<?php

use Modules\DesaModuleRelease\Models\User;

return [
    // default guard for this module
    'default' => 'desa_module_release_web',

    // Custom guard for this module
    'guards' => [
        'desa_module_release_web' => [
            'driver' => 'session',
            'provider' => 'desa_module_release_users',
        ],

        'desa_module_release_api' => [
            'driver' => 'jwt',
            'provider' => 'desa_module_release_users',
        ],
    ],

    // Custom user provider for this module
    'providers' => [
        'desa_module_release_users' => [
            'driver' => 'eloquent',
            'model' => User::class
        ],
    ],

    'passwords' => [
        'desa_module_release_users' => [
            'provider' => 'desa_module_release_users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60    
        ] 
    ],

    /*
    |--------------------------------------------------------------------------
    | OTP Settings
    |--------------------------------------------------------------------------
    | Control whether OTP is required in this module. You can enable it globally
    | or restrict it to certain roles. Developers can override via env or
    | publish config.
    */
    'otp' => [
        'enabled' => true, // optionally using env
        'roles'   => ['user'], // roles that must use OTP
        'expiry'  => 5, // minutes // optioanally using env
    ]
];