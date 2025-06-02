@extends('AdminDashboard.master')
@section('title', 'Create New Blog')

@section('css')
<!-- Include Quill CSS -->
<link rel="stylesheet" type="text/css" href="../assets/css/vendors/quill.snow.css">
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
    <h3>Create New Blog</h3>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="container">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <h5>Add New Course</h5>
                    </div>
                    <form action="{{ route('admin.blogs.store') }}"  method="POST" enctype="multipart/form-data" onsubmit="return submitForm()">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <!-- Title -->
                                    <div class="col-md-12 mb-3">
                                        <label class="col-sm-3 col-form-label">Title</label>
                                        <div class="col-sm-12">
                                            <input class="form-control" type="text" name="title"  required>
                                        </div>
                                    </div>

                                    <!-- Media Type -->
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Media Type</label>
                                        <select name="media_type" id="media_type" class="form-control" required>
                                            <option value="image" {{ old('media_type') == 'image' ? 'selected' : '' }}>Image</option>
                                            <option value="video" {{ old('media_type') == 'video' ? 'selected' : '' }}>Video</option>
                                        </select>
                                    </div>

                                    <!-- Description (Quill Editor) -->
                                    <div class="col-md-12 mb-3">
                                        
                                                    <div class="mb-12">
                                                        <label class="w-100">Content:</label>
                                                        <div id="editor8"></div>
                                                        <input type="hidden" name="content" id="content">
                                                    </div>
                                               
                                    </div>

                                    <!-- Media Upload -->
                                    <div class="col-md-12 mb-3" id="media_upload">
                                        <label class="form-label">Upload Media (Image/Video)</label>
                                        <input type="file" name="media_file" class="form-control">
                                        <small class="text-muted">Max 20MB | JPG, PNG, MP4, WebM, MOV</small>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-control" required>
                                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Published</option>
                                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Unpublished</option>
                                        </select>
                                    </div>

                                    <!-- Submit Buttons -->
                                    <div class="col-12 text-end mb-3">
                                        <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Cancel</a>
                                        <button type="submit" class="btn btn-success">Create Blog</button>
                                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<!-- Include Quill JS -->
<script src="../assets/js/editors/quill.js"></script>

<script>
    // Initialize Quill editor
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

    // Set Quill content to hidden input on form submission
    function submitForm() {
        document.getElementById('content').value = quill.root.innerHTML;
        return true;
    }
</script>
@endsection
