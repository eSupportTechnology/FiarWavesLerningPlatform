@extends('AdminDashboard.master')
@section('title', 'Manage Course Recordings')

@section('breadcrumb-title')
    <h3>Manage Recordings for {{ $course->name }}</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Course Management</li>
    <li class="breadcrumb-item">Courses</li>
    <li class="breadcrumb-item active">Manage Recordings</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Recordings for {{ $course->name }}</h5>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadRecordingModal">Add New Recording</button>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}</div>
                        @endif

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Week/Name</th>
                                    <th>Description</th>
                                    <th>Recording Link</th>
                                    <th>Batches</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recordings as $recording)
                                    <tr>
                                        <td>{{ $recording->recording_id }}</td>
                                        <td>{{ $recording->week_name }}</td>
                                        <td>{{ $recording->description ?? 'No Description' }}</td>
                                        <td><a href="{{ $recording->recording_url }}" target="_blank">Open Recording</a></td>
                                        <td>
                                            @foreach ($recording->batches as $batch)
                                                <span class="badge bg-info">{{ $batch->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $recording->recording_id }}">Edit</button>
                                            <form action="{{ route('coursesRecording.destroy', $recording->recording_id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal{{ $recording->recording_id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $recording->recording_id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Recording</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('coursesRecording.update', $recording->recording_id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Week/Name</label>
                                                            <input type="text" class="form-control" name="week_name" value="{{ $recording->week_name }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Recording URL</label>
                                                            <input type="url" class="form-control" name="recording_url" value="{{ $recording->recording_url }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Description</label>
                                                            <textarea class="form-control" name="description">{{ $recording->description }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Assign to Batches</label>
                                                            <div class="row">
                                                                @foreach($course->batches as $batch)
                                                                    <div class="col-md-4">
                                                                        <div class="form-check">
                                                                            <input type="checkbox" name="batches[]" value="{{ $batch->id }}" class="form-check-input" id="editbatch{{ $recording->recording_id }}_{{ $batch->id }}"
                                                                                {{ $recording->batches->contains($batch->id) ? 'checked' : '' }}>
                                                                            <label for="editbatch{{ $recording->recording_id }}_{{ $batch->id }}" class="form-check-label">{{ $batch->name }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Edit Modal -->
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload Recording Modal -->
    <div class="modal fade" id="uploadRecordingModal" tabindex="-1" aria-labelledby="uploadRecordingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadRecordingModalLabel">Add New Recording</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('coursesRecording.store', ['courseId' => $course->course_id]) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Week/Name</label>
                            <input type="text" class="form-control" name="week_name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Recording URL</label>
                            <input type="url" class="form-control" name="recording_url" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
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
                        <button type="submit" class="btn btn-primary">Save Recording</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
