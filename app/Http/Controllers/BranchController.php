<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    // Display all branches
    public function index()
    {
        $branches = Branch::all();
        return view('AdminDashboard.branches.index', compact('branches'));
    }

    // Show the form for creating a new branch
    public function create()
    {
        return view('AdminDashboard.branches.create');
    }

    // Store a newly created branch
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        Branch::create($request->all());

        return redirect()->route('branches.index')->with('success', 'Branch created successfully.');
    }

    // Show the form for editing a branch
    public function edit($id)
    {
        $branch = Branch::findOrFail($id);
        return view('AdminDashboard.branches.edit', compact('branch'));
    }

    // Update the branch
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $branch = Branch::findOrFail($id);
        $branch->update($request->all());

        return redirect()->route('branches.index')->with('success', 'Branch updated successfully.');
    }

    // Delete a branch
    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();

        return redirect()->route('branches.index')->with('success', 'Branch deleted successfully.');
    }
}