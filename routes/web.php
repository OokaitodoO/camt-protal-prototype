<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DepartmentController;

Route::get('/', [LoginController::class, 'index']);

Route::get('/department', [DepartmentController::class, 'index'])->name('department');

Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
Route::post('/departments/update', [DepartmentController::class, 'update'])->name('departments.update');
Route::post('/departments/create', [DepartmentController::class, 'store'])->name('departments.store');
Route::delete('/departments/{name}', [DepartmentController::class, 'destroy'])->name('departments.destroy');