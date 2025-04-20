<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PentadbirLoginController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;



Route::get('/', function () {
    return view('welcome');
});

Route::post('/loginPentadbir', [PentadbirLoginController::class, 'login']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);

