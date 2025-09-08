<?php

use Illuminate\Support\Facades\Route;
use Modules\DesaModuleRelease\Http\Controllers\Web\User\HomeController;
use Modules\DesaModuleRelease\Http\Controllers\Web\User\LogActivityController;
use Modules\DesaModuleRelease\Http\Controllers\Web\User\NotificationController;
use Modules\DesaModuleRelease\Http\Controllers\Web\User\ProfileController;
use Modules\DesaModuleRelease\Http\Controllers\Web\User\ProfileImageController;

/**
 * Wrap with prefix adn name 'user'
 * Authentication 
 */
Route::prefix('user')->middleware(desa_module_release_meta('snake').'-auth')->group(function () {
    /**
     * Check role 
     */
    Route::middleware(desa_module_release_meta('snake').'.role:'.desa_module_release_meta('snake').'_web,user', desa_module_release_meta('snake').'.verified', desa_module_release_meta('snake').'.status')->name('user.')->group(function () {
        // Index
        Route::get('/', [HomeController::class, 'index'])->name('index');

        // Profile
        Route::resource('profile', ProfileController::class)
            ->names('profile')
            ->parameter('profile', 'user')
            ->only([
                'index', 'edit', 'update'
            ]);
        
        // Profile Image
        Route::group([
            'prefix' => 'profile-image',
            'as' => 'profile-image.',
        ], function () {
            Route::get('', [ProfileImageController::class, 'edit'])->name('edit');
            Route::put('/', [ProfileImageController::class, 'update'])->name('update');
            Route::delete('/', [ProfileImageController::class, 'destroy'])->name('destroy');
        });

        // Log Activities
        Route::resource('logs', LogActivityController::class)
            ->names('logs')
            ->parameter('logs', 'log')
            ->only([
                'index', 'show'
            ]);

        // Notifications
        Route::group([
            'prefix' => 'notifications',
            'as' => 'notifications.',
        ], function () {
            Route::get('/', [NotificationController::class, 'index'])->name('index');
            Route::get('/{notification}', [NotificationController::class, 'show'])->name('show');
            Route::delete('/{notification}', [NotificationController::class, 'destroy'])->name('destroy');
            Route::post('/{notification}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('mark-as-read');
            Route::post('/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('mark-all-as-read');
            Route::post('/clear-all', [NotificationController::class, 'clearAll'])->name('clear-all');
        });
    });
});