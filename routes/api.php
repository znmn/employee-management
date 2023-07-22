<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Public routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('karyawan/senior', [EmployeeController::class, 'firstThree']);
    Route::apiResource('karyawan', EmployeeController::class);
    Route::get('cuti/kuota', [LeaveController::class, 'leaveQuota']);
    Route::get('cuti', [LeaveController::class, 'index']);
    Route::post('logout', [AuthController::class, 'logout']);
});