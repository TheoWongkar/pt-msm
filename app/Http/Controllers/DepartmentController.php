<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
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

        $departments = Department::withCount('employees')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('name', 'ASC')
            ->paginate(10);

        return view('department.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('department.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:departments',
            'color' => 'required|string|max:50|unique:departments',
        ]);

        Department::create($validated);

        return redirect()->route('department.index')->with('success', 'Departemen berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $department = Department::findOrFail($id);

        return view('department.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:departments,name,' . $id,
            'color' => 'required|string|max:50|unique:departments,color,' . $id,
        ]);

        $department = Department::findOrfail($id);

        $department->update($validated);

        return redirect()->route('department.index')->with('success', 'Departemen berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::findOrFail($id);

        $department->delete();

        return redirect()->route('department.index')->with('success', 'Departemen berhasil dihapus');
    }
}
