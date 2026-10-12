<?php

use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\Api\V1\PpidController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/posts/{slug}', [PostController::class, 'show']);

    Route::get('/ppids', [PpidController::class, 'index']);
    Route::get('/ppids/{id}', [PpidController::class, 'show']);
});
