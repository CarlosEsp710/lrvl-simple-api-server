<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [RegisterController::class, 'register'])->name('api.v1.register');

Route::apiResource('categories', CategoryController::class)->names('api.v1.categories');
