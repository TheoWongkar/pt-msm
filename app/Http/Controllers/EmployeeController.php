<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:50',
        ]);

        $search = $validated['search'] ?? null;
        $status = $validated['status'] ?? null;

        $employees = Employee::with('department')
            ->withTrashed()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->when($status, function ($query, $status) {
                if ($status === 'active') {
                    return $query->whereNull('deleted_at');
                } elseif ($status === 'inactive') {
                    return $query->onlyTrashed();
                }
            })
            ->orderBy('name', 'ASC')
            ->paginate(10);

        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();

        return view('employee.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Employee validations
            'department_id' => 'required|exists:departments,id',
            'nik' => 'required|string|max:20|unique:employees,nik',
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:13',
            'address' => 'required|string',
            'date_of_entry' => 'required|date',
            'date_of_birth' => 'required|date',
            'position' => 'required|string|max:30',
            'gender' => 'required|string|in:Pria,Wanita',
            'employee_status' => 'required|boolean',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

            // User validations
            'user_name' => 'required|string|max:255|unique:users,name',
            'user_email' => 'required|string|email|max:255|unique:users,email',
            'user_password' => 'required|string|min:8|confirmed',
            'user_role' => 'required|string|in:user,admin,operator',
        ]);

        // Store profile picture
        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        // Create employee and associate with the user
        $employee = Employee::create([
            'department_id' => $validated['department_id'],
            'nik' => $validated['nik'],
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'date_of_entry' => $validated['date_of_entry'],
            'date_of_birth' => $validated['date_of_birth'],
            'position' => $validated['position'],
            'gender' => $validated['gender'],
            'profile_picture' => $profilePicturePath,
        ]);

        // Create user and associate employee
        $employee->user()->create([
            'name' => $validated['user_name'],
            'email' => $validated['user_email'],
            'password' => Hash::make($validated['user_password']),
            'role' => $validated['user_role'],
        ]);

        if (!$request->employee_status) {
            $employee->delete();
        }

        return redirect()->route('employee.index')->with('success', 'Karyawan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::withTrashed()->with('user', 'department')->findOrFail($id);

        return view('employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::with('user', 'department')->withTrashed()->findOrFail($id);
        $departments = Department::all();

        return view('employee.edit', compact('employee', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find employee
        $employee = Employee::with('user', 'department')->withTrashed()->findOrFail($id);
        $userId = $employee->user->id;

        $validated = $request->validate([
            // Employee validations
            'department_id' => 'required|exists:departments,id',
            'nik' => 'required|string|max:20|unique:employees,nik,' . $id,
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:13',
            'address' => 'required|string',
            'date_of_entry' => 'required|date',
            'date_of_birth' => 'required|date',
            'position' => 'required|string|max:30',
            'gender' => 'required|string|in:Pria,Wanita',
            'employee_status' => 'required|boolean',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

            // User validations
            'user_name' => 'required|string|max:255|unique:users,name,' . $userId,
            'user_email' => 'required|string|email|max:255|unique:users,email,' . $userId,
            'user_password' => 'nullable|string|min:8|confirmed',
            'user_role' => 'required|string|in:user,admin,operator',
        ]);

        if ($request->input('reset_profile_picture') === 'true') {
            if ($employee->profile_picture) {
                Storage::disk('public')->delete($employee->profile_picture);
            }
            $employee->profile_picture = null;
        }

        // Jika ada file gambar baru diunggah
        if ($request->hasFile('profile_picture')) {
            if ($employee->profile_picture) {
                Storage::disk('public')->delete($employee->profile_picture);
            }
            // Simpan gambar baru
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $employee->profile_picture = $profilePicturePath; // Set kolom profile_picture dengan path baru
        }

        // Update employee data
        $employee->update([
            'department_id' => $validated['department_id'],
            'nik' => $validated['nik'],
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'date_of_entry' => $validated['date_of_entry'],
            'date_of_birth' => $validated['date_of_birth'],
            'position' => $validated['position'],
            'gender' => $validated['gender'],
            'employee_status' => $validated['employee_status'],
            'profile_picture' => $employee['profile_picture'],
        ]);

        // Update associated user data
        $employee->user->update([
            'name' => $validated['user_name'],
            'email' => $validated['user_email'],
            'password' => $validated['user_password'] ? Hash::make($validated['user_password']) : $employee->user->password,
            'role' => $validated['user_role'],
        ]);

        // Handle employee status
        if ($validated['employee_status']) {
            // Jika status diubah menjadi aktif, restore jika soft deleted
            if ($employee->trashed()) {
                $employee->restore();
            }
        } else {
            // Jika status diubah menjadi tidak aktif, soft delete
            if (!$employee->trashed()) {
                $employee->delete();
            }
        }

        return redirect()->route('employee.index')->with('success', 'Data Karyawan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::withTrashed()->findOrFail($id);
        $employee->delete();

        return redirect()->route('employee.index')->with('success', 'Karyawan berhasil dihapus');
    }
}
