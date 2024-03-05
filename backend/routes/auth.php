<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\AdminLoginController;
use App\Http\Controllers\API\Auth\UserLoginController;
use App\Http\Controllers\Api\auth\LogOutController;
use App\Http\Controllers\Api\auth\RegisterController;

// use App\Http\Controllers\API\Admins\CategoryController;
// use App\Http\Controllers\API\Users\OrderController;

// Route::post('login', LoginController::class);
// Route::post('logout', LogOutController::class);
Route::post('user/register', [RegisterController::class, 'userRegister']);
Route::post('admin/register', [RegisterController::class, 'adminRegister']);



Route::post('user/login', UserLoginController::class);
Route::post('admin/login', AdminLoginController::class);


// Only for users
    //Route::middleware(['auth:sanctum', 'user'])->group(function () {
    //       Route::get('/users/orders', [OrderController::class, 'orders']);
    // });
    // Only for admins
    // Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    //     Route::get('/admins/categories', [CategoryController::class, 'orders']);
    // });

//
