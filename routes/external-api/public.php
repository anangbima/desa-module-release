<?php 

use Illuminate\Support\Facades\Route;
use Modules\DesaModuleRelease\Http\Controllers\Api\External\UserController;

// User data 
Route::get('/users', [UserController::class, 'index']);