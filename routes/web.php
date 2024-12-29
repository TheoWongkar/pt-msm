<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DepartmentController;

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });

    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate']);
});

Route::middleware(['auth', 'auth.session'])->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('departemen', [DepartmentController::class, 'index'])->name('department.index');
    Route::get('departemen/tambah', [DepartmentController::class, 'create'])->name('department.create');
    Route::POST('departemen/tambah', [DepartmentController::class, 'store'])->name('department.store');
    Route::get('departemen/edit/{id}', [DepartmentController::class, 'edit'])->name('department.edit');
    Route::PUT('departemen/edit/{id}', [DepartmentController::class, 'update'])->name('department.update');
    Route::delete('departemen/{id}', [DepartmentController::class, 'destroy'])->name('department.destroy');
});
