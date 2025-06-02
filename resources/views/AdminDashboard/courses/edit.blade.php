@extends('AdminDashboard.master')
@section('title', 'Edit Course')

@section('css')
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
    <h3>Edit Course</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Course Management</li>
    <li class="breadcrumb-item active">Edit Course</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Update Course</h5>
                </div>
                <form action="{{ route('courses.update', $course->course_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Course Name</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="name" value="{{ $course->name }}" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <div class="email-wrapper">
                                            <div class="theme-form">
                                                <div class="mb-3">
                                                    <label class="w-100">Content:</label>
                                                    <div id="editor8"></div>
                                                    <input type="hidden" name="description" id="description">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Duration (Days)</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="number" name="duration" value="{{ $course->duration }}" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Total Price (Rs.)</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="number" name="total_price" value="{{ $course->total_price }}" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">First Payment (Rs.)</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="number" name="first_payment" value="{{ $course->first_payment }}" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Course Image</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="file" name="image" accept="image/*">
                                        @if($course->image)
                                            <img src="{{ asset($course->image) }}" alt="Course Image" width="200" class="img-thumbnail mt-2">
                                        @endif
                                    </div>
                                </div>

                                <!-- Location -->
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Location</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="location" value="{{ $course->location }}">
                                    </div>
                                </div>

                                <!-- Mode -->
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Mode</label>
                                    <div class="col-sm-9">
                                        <select name="mode" class="form-control" required>
                                            <option value="online" {{ $course->mode === 'online' ? 'selected' : '' }}>Online</option>
                                            <option value="offline" {{ $course->mode === 'offline' ? 'selected' : '' }}>Offline</option>
                                            <option value="hybrid" {{ $course->mode === 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Branch -->
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Branch</label>
                                    <div class="col-sm-9">
                                        <select name="branch_id" class="form-control">
                                            <option value="">-- Select Branch --</option>
                                            @foreach($branches as $branch)
                                                <option value="{{ $branch->id }}" {{ $course->branch_id == $branch->id ? 'selected' : '' }}>
                                                    {{ $branch->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Video Link -->
                                <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Video Link (optional)</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="url" name="video_link" placeholder="https://youtube.com/..." value="{{ old('video_link', $course->video_link) }}">
                                        </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="col-sm-9 offset-sm-3">
                            <button class="btn btn-primary" type="submit" onclick="submitForm()">Update</button>
                            <a href="{{ route('courses.index') }}" class="btn btn-light">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="../assets/js/editors/quill.js"></script>
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

    // Set the initial content of the editor
    quill.root.innerHTML = `{!! $course->description !!}`;

    function submitForm() {
        document.getElementById('description').value = quill.root.innerHTML;
    }
</script>
@endsection