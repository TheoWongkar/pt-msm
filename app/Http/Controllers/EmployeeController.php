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
        ]);

        $search = $validated['search'] ?? null;

        $employees = Employee::with('department')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('date_of_entry', 'ASC')
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
        $request->validate([
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
            'department_id' => $request->department_id,
            'nik' => $request->nik,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'date_of_entry' => $request->date_of_entry,
            'date_of_birth' => $request->date_of_birth,
            'position' => $request->position,
            'gender' => $request->gender,
            'employee_status' => $request->employee_status,
            'profile_picture' => $profilePicturePath,
        ]);

        // Create user and associate employee
        $employee->user()->create([
            'name' => $request->user_name,
            'email' => $request->user_email,
            'password' => Hash::make($request->user_password),
            'role' => $request->user_role,
        ]);

        return redirect()->route('employee.index')->with('success', 'Karyawan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::with('user', 'department')->findOrFail($id);

        return view('employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::with('user')->findOrFail($id);
        $departments = Department::all();

        return view('employee.edit', compact('employee', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find employee
        $employee = Employee::with('department', 'user')->findOrFail($id);
        $userId = $employee->user->id;

        $request->validate([
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
                Storage::disk('public')->delete($employee->profile_picture); // Hapus gambar lama dari storage
            }
            $employee->profile_picture = null; // Set kolom profile_picture ke null
        }

        // Jika ada file gambar baru diunggah
        if ($request->hasFile('profile_picture')) {
            if ($employee->profile_picture) {
                Storage::disk('public')->delete($employee->profile_picture); // Hapus gambar lama dari storage
            }
            // Simpan gambar baru
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $employee->profile_picture = $profilePicturePath; // Set kolom profile_picture dengan path baru
        }

        // Update employee data
        $employee->update([
            'department_id' => $request->department_id,
            'nik' => $request->nik,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'date_of_entry' => $request->date_of_entry,
            'date_of_birth' => $request->date_of_birth,
            'position' => $request->position,
            'gender' => $request->gender,
            'employee_status' => $request->employee_status,
            'profile_picture' => $employee->profile_picture,
        ]);

        // Update associated user data
        $employee->user->update([
            'name' => $request->user_name,
            'email' => $request->user_email,
            'password' => $request->user_password ? Hash::make($request->user_password) : $employee->user->password,
            'role' => $request->user_role,
        ]);

        return redirect()->route('employee.index')->with('success', 'Data Karyawan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id);

        if ($employee->profile_picture) {
            Storage::disk('public')->delete($employee->profile_picture);
        }

        $employee->delete();

        return redirect()->route('employee.index')->with('success', 'Karyawan berhasil dihapus');
    }
}
