<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Employee;

class EmployeeAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('AdminDashboard.employees.login');
    }

    public function showRegisterForm()
    {
        return view('admin.auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('employee')->attempt($credentials)) {
            $request->session()->regenerate();

            // ✅ Set session value manually
            $employee = Auth::guard('employee')->user();
            session(['employee' => $employee]);

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }


    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:employees,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,staff,manager', // or customize roles
        ]);

        $employee = \App\Models\Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        Auth::guard('employees')->login($employee);

        return redirect()->route('admin.dashboard')->with('success', 'Admin registered successfully!');
    }


    

    public function logout(Request $request)
    {
        Auth::guard('employee')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function index()
    {
        $employees = Employee::latest()->paginate(10); // Or ->get() if no pagination

        return view('AdminDashboard.employees.index', compact('employees'));
    }
}
