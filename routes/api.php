<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| These routes are typically used for API requests (mobile apps, JS fetch, etc).
| They are stateless, so authentication should use tokens (like Sanctum).
|
*/

// Default test route
Route::get('/ping', function () {
    return response()->json(['message' => 'API is working ✅']);
});

// Example: Get current logged-in user (requires Sanctum)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




