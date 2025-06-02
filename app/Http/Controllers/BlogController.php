<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    // Show all blogs
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('AdminDashboard.blogs.index', compact('blogs'));
    }

    // Show create form
    public function create()
    {
        return view('AdminDashboard.blogs.create');
    }

    // Store a new blog
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'media_type' => 'required|in:image,video',
            'media_file' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov,avi,webm', // 20MB max
            'status' => 'required|boolean',
        ]);

        $mediaPath = null;
        if ($request->hasFile('media_file')) {
            $folder = $request->media_type === 'video' ? 'blog_videos' : 'blog_images';
            $mediaPath = $request->file('media_file')->store($folder, 'public');
        }

        Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'media_type' => $request->media_type,
            'media_path' => $mediaPath,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('AdminDashboard.blogs.edit', compact('blog'));
    }

    // Update an existing blog
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'media_type' => 'required|in:image,video',
            'media_file' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov,avi,webm',
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('media_file')) {
            if ($blog->media_path && Storage::disk('public')->exists($blog->media_path)) {
                Storage::disk('public')->delete($blog->media_path);
            }

            $folder = $request->media_type === 'video' ? 'blog_videos' : 'blog_images';
            $blog->media_path = $request->file('media_file')->store($folder, 'public');
        }

        $blog->update([
            'title' => $request->title,
            'content' => $request->content,
            'media_type' => $request->media_type,
            'media_path' => $blog->media_path,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
    }

    // Delete blog
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        if ($blog->media_path && Storage::disk('public')->exists($blog->media_path)) {
            Storage::disk('public')->delete($blog->media_path);
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
    }
}
