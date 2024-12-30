<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
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

    Route::get('karyawan', [EmployeeController::class, 'index'])->name('employee.index');
    Route::get('karyawan/lihat/{id}', [EmployeeController::class, 'show'])->name('employee.show');
    Route::get('karyawan/tambah', [EmployeeController::class, 'create'])->name('employee.create');
    Route::post('karyawan/tambah', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('karyawan/ubah/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::put('karyawan/ubah/{id}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::delete('karyawan/hapus/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
});
