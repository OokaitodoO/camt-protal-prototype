<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DepartmentController;

Route::get('/', [LoginController::class, 'index']);

Route::get('/department', [DepartmentController::class, 'index'])->name('department');;