@extends('AdminDashboard.master')
@section('title', 'Manage Course Files')

@section('breadcrumb-title')
    <h3>Manage Files for {{ $course->name }}</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Course Management</li>
    <li class="breadcrumb-item">Courses</li>
    <li class="breadcrumb-item active">Manage Files</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Files for {{ $course->name }}</h5>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadFileModal">Add New File</button>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}</div>
                        @endif

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>File Name</th>
                                    <th>File Type</th>
                                    <th>Available Batches</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($files as $file)
                                    <tr>
                                        <td>{{ $file->file_id }}</td>
                                        <td>
                                            <a href="{{ asset($file->file_path) }}" target="_blank">
                                                {{ $file->file_name }}
                                            </a>
                                        </td>
                                        <td>{{ $file->file_type }}</td>
                                        <td>
                                            @foreach ($file->batches as $batch)
                                                <span class="badge bg-info">{{ $batch->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <!-- Edit Button -->
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editFileModal{{ $file->file_id }}">
                                                Edit
                                            </button>

                                            <form action="{{ route('courseFile.destroy', $file->file_id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload File Modal -->
    <div class="modal fade" id="uploadFileModal" tabindex="-1" aria-labelledby="uploadFileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('courseFile.store', ['courseId' => $course->course_id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Upload New File</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="file_name" class="form-label">File Name</label>
                            <input type="text" name="file_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="files" class="form-label">Select Files</label>
                            <input type="file" name="files[]" class="form-control" accept=".pdf,.docx,.txt" multiple required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Assign to Batches</label>
                            <div class="row">
                                @foreach($course->batches as $batch)
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" name="batches[]" value="{{ $batch->id }}" class="form-check-input" id="batch{{ $batch->id }}">
                                            <label for="batch{{ $batch->id }}" class="form-check-label">{{ $batch->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Upload Files</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editFileModal{{ $file->file_id }}" tabindex="-1" aria-labelledby="editFileModalLabel{{ $file->file_id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('courseFile.update', $file->file_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title">Edit File: {{ $file->file_name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">File Name</label>
                            <input type="text" name="file_name" class="form-control" value="{{ $file->file_name }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Assign to Batches</label>
                            <div class="row">
                                @foreach($course->batches as $batch)
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" name="batches[]" value="{{ $batch->id }}"
                                                class="form-check-input" id="editBatch{{ $file->file_id }}-{{ $batch->id }}"
                                                {{ $file->batches->contains($batch->id) ? 'checked' : '' }}>
                                            <label for="editBatch{{ $file->file_id }}-{{ $batch->id }}" class="form-check-label">{{ $batch->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
