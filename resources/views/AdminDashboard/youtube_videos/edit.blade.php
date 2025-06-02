@extends('AdminDashboard.master')

@section('title', 'Edit YouTube Video')

@section('breadcrumb-title')
    <h3>Edit YouTube Video</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.youtube-videos.index') }}">YouTube Videos</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Edit Video</h5>
        </div>

        <div class="card-body">
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

            <form action="{{ route('admin.youtube-videos.update', $video->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="title" class="form-label">Video Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $video->title) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="youtube_url" class="form-label">YouTube URL</label>
                        <input type="url" name="youtube_url" id="youtube_url" class="form-control" value="{{ old('youtube_url', $video->youtube_url) }}" required>
                    </div>

                    <div class="col-12 text-end">
                        <a href="{{ route('admin.youtube-videos.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Video</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
