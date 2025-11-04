<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/profiles', ProfileController::class);
    Route::apiResource('/tasks', TaskController::class);
    Route::get('/tasks/get/orderd',[TaskController::class,'getTaskBypriority'] );
    Route::post('/tasks/{id}/favorite', [TaskController::class, 'addToFavorite']);
        Route::delete('tasks/{task}/favorite', [TaskController::class, 'removeformfavorite']);
            Route::get('tasks/{task}/categories', [TaskController::class, 'getTaskCategories']);

    Route::get('categories/{categoryId}/tasks', [TaskController::class, 'getCategorieTask']);




});

