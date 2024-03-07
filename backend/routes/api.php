<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Event\EventController;
use App\Http\Controllers\Api\Event\EventApplyController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth:sanctum','user'])->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware(['auth:sanctum','admin'])->group(function () {
//     // Route::get('/event/list', [EventController::class, 'index']);
//     // Route::post('/event/create', [EventController::class, 'store']);
//     Route::apiResource('/event', EventController::class);
//     Route::apiResource('/event_apply', EventApplyController::class);
// });

// Route::middleware(['auth:sanctum','user'])->group(function () {
//     Route::apiResource('/event_apply', EventApplyController::class);
// });

Route::get('/event', [EventController::class,'index']);
Route::post('/event/create', [EventController::class,'store']);
Route::get('/event/view/{id}', [EventController::class,'show']);
Route::put('/event/update/{id}', [EventController::class,'update']);
Route::delete('/event/delete/{id}', [EventController::class,'destroy']);

Route::get('/event_apply', [EventApplyController::class,'index']);
Route::post('/event_apply/create', [EventApplyController::class,'store']);
Route::get('/event_apply/view/{id}', [EventApplyController::class,'store']);
