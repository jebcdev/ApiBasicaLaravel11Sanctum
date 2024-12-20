<?php

use App\Http\Controllers\Api\_ApiController;
use App\Http\Controllers\Api\AdminCategoryController;
use App\Http\Controllers\Api\AdminStatusController;
use App\Http\Controllers\Api\AdminTaskController;
use App\Http\Controllers\Api\AdminUserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('/v1')->group(function () {

    Route::get('/', [_ApiController::class, 'index'])->name('index');

    /* Auth Routes */

    Route::post('/register', [AuthController::class, 'register'])->name('register');

    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::middleware(['auth:sanctum'])->group(function () {

        Route::get('/profile', [AuthController::class, 'profile'])->name('profile');

        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });

    /* Auth Routes */

    /* Admin Routes */
    Route::prefix('/admin')->middleware(['auth:sanctum', 'admin'])->group(function () {

        /* Categories */
        Route::apiResource('/categories', AdminCategoryController::class)->names('admin.categories');
        /* Categories */

        /* Statuses */
        Route::apiResource('/statuses', AdminStatusController::class)->names('admin.statuses');
        /* Statuses */

        /* Tasks */
        Route::apiResource('/tasks', AdminTaskController::class)->names('admin.tasks');
        /* Tasks */

        /* Users */
        Route::apiResource('/users', AdminUserController::class)->names('admin.users');
        /* Users */
    });
    /* Admin Routes */

    /* Users Tasks */
    Route::apiResource('/tasks', TaskController::class)->middleware(['auth:sanctum'])->names('tasks');
    /* Users Tasks */


















    /*  */
});

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum'); */
