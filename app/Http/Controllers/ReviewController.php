<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Course;

class ReviewController extends Controller
{
    // Show all reviews
    public function index()
    {
        $reviews = Review::latest()->paginate(10);
        return view('AdminDashboard.reviews.index', compact('reviews'));
    }

    // Show create form
    public function create()
    {
        $courses = Course::all();
        return view('AdminDashboard.reviews.create', compact('courses'));
    }

    // Store new review
    public function store(Request $request)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
            'status' => 'required|in:pending,approved',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('reviews', 'public');
        }

        Review::create([
            'student_name' => $request->student_name,
            'rating'       => $request->rating,
            'comment'      => $request->comment,
            'status'       => $request->status,
            'image'        => $imagePath,
        ]);

        return redirect()->route('admin.reviews.index')->with('success', 'Review added successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $review = Review::findOrFail($id);
        $courses = Course::all(); // in case you want to reassign course
        return view('AdminDashboard.reviews.edit', compact('review', 'courses'));
    }

    // Update review
    public function update(Request $request, $id)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
            'status' => 'required|in:pending,approved',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $review = Review::findOrFail($id);

        $data = $request->only(['student_name', 'rating', 'comment', 'status']);

        // Image update logic
        if ($request->hasFile('image')) {
            if ($review->image && Storage::disk('public')->exists($review->image)) {
                Storage::disk('public')->delete($review->image);
            }
            $data['image'] = $request->file('image')->store('reviews', 'public');
        }

        $review->update($data);

        return redirect()->route('admin.reviews.index')->with('success', 'Review updated successfully.');
    }

    // Delete review
    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        // Delete image file if exists
        if ($review->image && \Storage::disk('public')->exists($review->image)) {
            \Storage::disk('public')->delete($review->image);
        }

        $review->delete();

        return redirect()->route('admin.reviews.index')->with('success', 'Review deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $review = Review::findOrFail($id);

        $review->status = $review->status === 'approved' ? 'pending' : 'approved';
        $review->save();

        return back()->with('success', 'Review status updated successfully.');
    }

}
