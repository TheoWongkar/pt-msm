<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $employeeTotal = Employee::withTrashed()->count();
        $employeeActive = Employee::count();
        $employeeInactive = Employee::onlyTrashed()->count();

        $departmentTotal = Department::count();
        $departmentWithMostEmployees = Department::withCount('employees')
            ->orderByDesc('employees_count')
            ->first();

        return view('index', compact('employeeTotal', 'employeeActive', 'employeeInactive', 'departmentTotal', 'departmentWithMostEmployees'));
    }
}
