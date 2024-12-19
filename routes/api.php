<?php

use App\Http\Controllers\Api\_ApiController;
use App\Http\Controllers\Api\AdminCategoryController;
use App\Http\Controllers\Api\AuthController;
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
        Route::apiResource('/categories',AdminCategoryController::class)->names('admin.categories');
        /* Categories */
    });
    /* Admin Routes */




















    /*  */
});

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum'); */
