<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// routes/api.php
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('timesheets', TimesheetController::class);

    Route::post('users/update', [UserController::class, 'update']);
    Route::post('users/delete', [UserController::class, 'destroy']);
    Route::post('projects/update', [ProjectController::class, 'update']);
    Route::post('projects/delete', [ProjectController::class, 'destroy']);
    Route::post('timesheets/update', [TimesheetController::class, 'update']);
    Route::post('timesheets/delete', [TimesheetController::class, 'destroy']);
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
