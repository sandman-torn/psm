<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PentadbirLoginController;


Route::get('/', function () {
    return view('welcome');
});

Route::post('/loginPentadbir', [PentadbirLoginController::class, 'login']);
