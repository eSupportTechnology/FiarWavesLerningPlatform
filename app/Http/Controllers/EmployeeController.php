<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    // Show list of employees
    public function index()
    {
        $employees = Employee::latest()->paginate(10);
        return view('AdminDashboard.employees.index', compact('employees'));
    }

    // Show create form
    public function create()
    {
        return view('AdminDashboard.employees.create');
    }

    // Store employee
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        try {
            Employee::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => true
            ]);

            return redirect()->route('admin.employees.index')->with('success', 'Employee created successfully.');

        } catch (\Throwable $e) {
            Log::error('Employee Create Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to create employee.');
        }
    }

    // Show edit form
    public function edit(Employee $employee)
    {
        return view('AdminDashboard.employees.edit', compact('employee'));
    }

    // Update employee
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        try {
            $employee->name = $request->name;
            $employee->email = $request->email;
            if ($request->filled('password')) {
                $employee->password = Hash::make($request->password);
            }
            $employee->save();

            return redirect()->route('admin.employees.index')->with('success', 'Employee updated successfully.');

        } catch (\Throwable $e) {
            Log::error('Employee Update Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to update employee.');
        }
    }

    // Delete employee
    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();
            return redirect()->route('admin.employees.index')->with('success', 'Employee deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Employee Delete Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete employee.');
        }
    }
}
