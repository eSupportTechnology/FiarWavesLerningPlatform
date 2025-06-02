<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Course;
use App\Models\CustomerCourseBatch;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    // Show all batches
    public function index()
    {
        $batches = Batch::with('course')->latest()->get();
        return view('AdminDashboard.batches.index', compact('batches'));
    }

    // Show create form
    public function create()
    {
        $courses = Course::all();
        return view('AdminDashboard.batches.create', compact('courses'));
    }

    // Store batch
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,course_id',
            'name' => 'required|string|max:100',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        Batch::create($request->all());

        return redirect()->route('admin.batches.index')->with('success', 'Batch created successfully.');
    }

    // Edit batch
    public function edit($id)
    {
        $batch = Batch::findOrFail($id);
        $courses = Course::all();
        return view('AdminDashboard.batches.edit', compact('batch', 'courses'));
    }

    // Update batch
    public function update(Request $request, $id)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,course_id',
            'name' => 'required|string|max:100',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $batch = Batch::findOrFail($id);
        $batch->update($request->all());

        return redirect()->route('admin.batches.index')->with('success', 'Batch updated successfully.');
    }

    // Delete batch
    public function destroy($id)
    {
        $batch = Batch::findOrFail($id);
        $batch->delete();

        return redirect()->route('admin.batches.index')->with('success', 'Batch deleted successfully.');
    }

    //update customer batches
    public function updateBatch(Request $request, $id)
    {
        $request->validate([
            'batch_id' => 'required|exists:batches,id',
        ]);

        $assignment = CustomerCourseBatch::findOrFail($id);
        $assignment->batch_id = $request->batch_id;
        $assignment->save();

        return back()->with('success', 'Batch updated successfully.');
    }

}
