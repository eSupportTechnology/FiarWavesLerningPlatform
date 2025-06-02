@extends('AdminDashboard.master')
@section('title', 'Edit Blog')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/quill.snow.css') }}">
@endsection

@section('style')
<style>
    #editor8 {
        height: 300px;
        background-color: white;
    }
</style>
@endsection

@section('breadcrumb-title')
    <h3>Edit Blog</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}">Blogs</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h5>Edit Blog</h5>
                </div>

                <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return submitForm()">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <!-- Title -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Title</label>
                                    <input class="form-control" type="text" name="title" value="{{ old('title', $blog->title) }}" required>
                                </div>

                                <!-- Media Type -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Media Type</label>
                                    <select name="media_type" id="media_type" class="form-control" required>
                                        <option value="image" {{ $blog->media_type == 'image' ? 'selected' : '' }}>Image</option>
                                        <option value="video" {{ $blog->media_type == 'video' ? 'selected' : '' }}>Video</option>
                                    </select>
                                </div>

                                <!-- Content (Quill Editor) -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Content</label>
                                    <div id="editor8"></div>
                                    <input type="hidden" name="content" id="content" value="{{ old('content', $blog->content) }}">

                                </div>

                                <!-- Media Upload -->
                                <div class="col-md-12 mb-3" id="media_upload">
                                    <label class="form-label">Upload Media (Image/Video)</label>
                                    <input type="file" name="media_file" class="form-control">
                                    <small class="text-muted">Leave blank to keep existing. Max 20MB.</small>
                                    @if($blog->media_path)
                                        <div class="mt-2">
                                            <strong>Current:</strong><br>
                                            @if($blog->media_type == 'image')
                                                <img src="{{ asset('storage/' . $blog->media_path) }}" width="200" class="rounded">
                                            @else
                                                <video width="300" controls>
                                                    <source src="{{ asset('storage/' . $blog->media_path) }}">
                                                    Your browser does not support the video tag.
                                                </video>
                                            @endif
                                        </div>
                                    @endif
                                </div>

                                <!-- Status -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="1" {{ $blog->status == 1 ? 'selected' : '' }}>Published</option>
                                        <option value="0" {{ $blog->status == 0 ? 'selected' : '' }}>Unpublished</option>
                                    </select>
                                </div>

                                <!-- Submit -->
                                <div class="col-12 text-end mb-3">
                                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Update Blog</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/js/editors/quill.js') }}"></script>

<script>
        var quill = new Quill('#editor8', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'size': ['small', false, 'large', 'huge'] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'script': 'sub'}, { 'script': 'super' }],
                ['blockquote', 'code-block'],
                [{ 'header': 1 }, { 'header': 2 }],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'indent': '-1'}, { 'indent': '+1' }],
                [{ 'direction': 'rtl' }],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'align': [] }],
                ['link', 'image', 'video'],
                ['clean']
            ]
        }
    });

    // Set initial content into Quill editor from hidden input
    quill.root.innerHTML = document.getElementById('content').value;

    // Sync content to hidden input before form submit
    function submitForm() {
        document.getElementById('content').value = quill.root.innerHTML;
        return true;
    }

    // Optional: change label when media_type is changed
    document.getElementById('media_type').addEventListener('change', function () {
        const label = document.querySelector('#media_upload label');
        label.textContent = this.value === 'video' ? 'Upload Video' : 'Upload Image';
    });
</script>
@endsection
