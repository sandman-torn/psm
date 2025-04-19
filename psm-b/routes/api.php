<?php

use App\Http\Controllers\Auth\PentadbirLoginController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\UnitController;


Route::get('/user', function (Request $request) {
    return UserResource::make($request->user()->load('roles'));
    
    

})->middleware('auth:sanctum');


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('students', StudentController::class);
    Route::apiResource('users', UserController::class);

    Route::get('student/{student}', [StudentController::class, 'show']);
    Route::get('classes', ClassController::class);
    Route::get('sections', SectionController::class);
    Route::post('/loginPentadbir', [PentadbirLoginController::class, 'login']);
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::get('/units', [UnitController::class, 'index']);



});

