<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });

    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate']);
});

Route::middleware(['auth', 'auth.session'])->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/beranda', DashboardController::class)->name('dashboard');

    Route::get('departemen', [DepartmentController::class, 'index'])->name('department.index');
    Route::get('departemen/tambah', [DepartmentController::class, 'create'])->name('department.create');
    Route::POST('departemen/tambah', [DepartmentController::class, 'store'])->name('department.store');
    Route::get('departemen/ubah/{id}', [DepartmentController::class, 'edit'])->name('department.edit');
    Route::PUT('departemen/ubah/{id}', [DepartmentController::class, 'update'])->name('department.update');
    Route::delete('departemen/hapus/{id}', [DepartmentController::class, 'destroy'])->name('department.destroy');

    Route::get('karyawan', [EmployeeController::class, 'index'])->name('employee.index');
    Route::get('karyawan/lihat/{id}', [EmployeeController::class, 'show'])->name('employee.show');
    Route::get('karyawan/tambah', [EmployeeController::class, 'create'])->name('employee.create');
    Route::post('karyawan/tambah', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('karyawan/ubah/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::put('karyawan/ubah/{id}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::delete('karyawan/hapus/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
});
