<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseZoomLink;
use Illuminate\Http\Request;

class CourseZoomLinkController extends Controller
{
    // Show Zoom Links for a specific course
    public function index($courseId)
    {
        $course = Course::with('batches')->findOrFail($courseId);
        $zoomLinks = CourseZoomLink::with('batches')->where('course_id', $courseId)->get();
        return view('AdminDashboard.courseZoomLinks.index', compact('course', 'zoomLinks'));
    }

    // Updated Store
    public function store(Request $request, $courseId)
    {
        $request->validate([
            'week_name' => 'required|string|max:100',
            'zoom_link' => 'required|url',
            'description' => 'nullable|string',
            'batches' => 'nullable|array',
            'batches.*' => 'exists:batches,id',
        ]);

        $zoom = CourseZoomLink::create([
            'course_id' => $courseId,
            'week_name' => $request->week_name,
            'zoom_link' => $request->zoom_link,
            'description' => $request->description,
        ]);

        $zoom->batches()->attach($request->batches ?? []);

        return redirect()->route('coursesZoomLinks.index', $courseId)->with('success', 'Zoom Link added successfully.');
    }


    // Add Update
    public function update(Request $request, $id)
    {
        $request->validate([
            'week_name' => 'required|string|max:100',
            'zoom_link' => 'required|url',
            'description' => 'nullable|string',
            'batches' => 'nullable|array',
            'batches.*' => 'exists:batches,id',
        ]);

        $zoom = CourseZoomLink::findOrFail($id);
        $zoom->update([
            'week_name' => $request->week_name,
            'zoom_link' => $request->zoom_link,
            'description' => $request->description,
        ]);

        $zoom->batches()->sync($request->batches ?? []);

        return back()->with('success', 'Zoom Link updated successfully.');
    }

    
    // Delete a Zoom Link
    public function destroy($zoomLinkId)
    {
        $zoomLink = CourseZoomLink::findOrFail($zoomLinkId);
        $zoomLink->delete();

        return redirect()->back()->with('success', 'Zoom Link deleted successfully.');
    }
}
