<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\YoutubeVideo;

class YoutubeVideoController extends Controller
{
    // Show all videos
    public function index()
    {
        $videos = YoutubeVideo::latest()->paginate(10); // Paginated
        return view('AdminDashboard.youtube_videos.index', compact('videos'));
    }

    // Show the create form
    public function create()
    {
        return view('AdminDashboard.youtube_videos.create');
    }

    // Store a new video
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'youtube_url' => 'required|url',
        ]);

        YoutubeVideo::create([
            'title' => $request->title,
            'youtube_url' => $request->youtube_url,
        ]);

        return redirect()->route('admin.youtube-videos.index')->with('success', 'Video added successfully!');
    }


    // Show edit form
    public function edit($id)
    {
        $video = YoutubeVideo::findOrFail($id);
        return view('AdminDashboard.youtube_videos.edit', compact('video'));
    }

    // Update video
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'youtube_url' => 'required|url',
        ]);

        $video = YoutubeVideo::findOrFail($id);
        $video->title = $request->title;
        $video->youtube_url = $request->youtube_url;
        $video->save();

        return redirect()->route('admin.youtube-videos.index')->with('success', 'Video updated successfully!');
    }

    // Delete video
    public function destroy($id)
    {
        $video = YoutubeVideo::findOrFail($id);
        $video->delete();

        return redirect()->route('admin.youtube-videos.index')->with('success', 'Video deleted successfully!');
    }
}
