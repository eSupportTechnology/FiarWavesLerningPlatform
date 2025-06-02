@extends('AdminDashboard.master')
@section('title', 'Create New Course')

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
    <h3>Create New Course</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Course Management</li>
    <li class="breadcrumb-item active">Create New Course</li>
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
                    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <!-- Course Name -->
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Course Name</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="name" placeholder="Course Name" required>
                                        </div>
                                    </div>

                                    <!-- Description (Quill Editor) -->
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

                                    <!-- Duration -->
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Duration (Days)</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="number" name="duration" placeholder="Course Duration in Days" required>
                                        </div>
                                    </div>

                                    <!-- Total Price -->
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Total Price (Rs.)</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="number" name="total_price" placeholder="Total Price" required>
                                        </div>
                                    </div>

                                    <!-- First Payment -->
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">First Payment (Rs.)</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="number" name="first_payment" placeholder="First Payment" required>
                                        </div>
                                    </div>

                                    <!-- Upload Image -->
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Course Image</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="file" name="image" accept="image/*">
                                        </div>
                                    </div>

                                    <!-- Location -->
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Location</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="location" placeholder="Course Location (e.g., Colombo, Online)">
                                        </div>
                                    </div>

                                    <!-- Mode -->
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Mode</label>
                                        <div class="col-sm-9">
                                            <select name="mode" class="form-control" required>
                                                <option value="online">Online</option>
                                                <option value="offline">Offline</option>
                                                <option value="hybrid">Hybrid</option>
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
                                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Video Link -->
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Video Link (optional)</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="url" name="video_link" placeholder="https://youtube.com/..." value="{{ old('video_link') }}">
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer text-end">
                            <div class="col-sm-9 offset-sm-3">
                                <button class="btn btn-primary" type="submit" onclick="submitForm()">Submit</button>
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
        document.getElementById('description').value = quill.root.innerHTML;
    }
</script>
@endsection
