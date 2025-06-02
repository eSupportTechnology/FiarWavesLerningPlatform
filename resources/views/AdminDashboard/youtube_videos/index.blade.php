@extends('AdminDashboard.master')

@section('title', 'YouTube Videos')

@section('breadcrumb-title')
    <h3>YouTube Videos</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Media</li>
    <li class="breadcrumb-item active">YouTube Videos</li>
@endsection

@section('content')
<div class="container-fluid">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error!</strong> Please check the form below.<br><br>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Create Form -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Add New YouTube Video</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.youtube-videos.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="title" class="form-label">Video Title</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Enter video title" required>
                    </div>
                    <div class="col-md-6">
                        <label for="youtube_url" class="form-label">YouTube URL</label>
                        <input type="url" name="youtube_url" id="youtube_url" class="form-control" placeholder="https://www.youtube.com/watch?v=..." required>
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-success">Add Video</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Video List -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>All YouTube Videos</h5>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Preview</th>
                            <th>URL</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($videos as $index => $video)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $video->title }}</td>
                                <td>
                                    <iframe width="200" height="113"
                                        src="https://www.youtube.com/embed/{{ \Illuminate\Support\Str::after($video->youtube_url, 'v=') }}"
                                        frameborder="0" allowfullscreen>
                                    </iframe>
                                </td>
                                <td>
                                    <a href="{{ $video->youtube_url }}" target="_blank">
                                        {{ $video->youtube_url }}
                                    </a>
                                </td>
                                <td class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.youtube-videos.edit', $video->id) }}" class="btn btn-sm btn-info">Edit</a>
                                    <form action="{{ route('admin.youtube-videos.destroy', $video->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this video?');">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5">No videos found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
