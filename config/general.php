<?php 

return [
    // Module name
    'name' => env('DESA_MODULE_RELEASE_NAME', 'Desa Module Release'),

    // Module slug
    'slug' => env('DESA_MODULE_RELEASE_SLUG', 'desa-module-release'),

    // Setting enabled state
    'enabled' => env('DESA_MODULE_RELEASE_ENABLED', true),

    // route prefix 
    'route_prefix' => env('DESA_MODULE_RELEASE_PREFIX', 'desa-module-release'),

    // view namespace
    'view_namespace' => env('DESA_MODULE_RELEASE_VIEW', 'desa-module-release'),

    // Module domain
    'domain' => env('DESA_MODULE_RELEASE_DOMAIN', 'desamodulerelease.test'),
];