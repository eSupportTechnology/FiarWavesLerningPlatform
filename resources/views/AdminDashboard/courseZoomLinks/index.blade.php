@extends('AdminDashboard.master')
@section('title', 'Manage Course Zoom Links')

@section('breadcrumb-title')
    <h3>Manage Zoom Links for {{ $course->name }}</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Course Management</li>
    <li class="breadcrumb-item">Courses</li>
    <li class="breadcrumb-item active">Manage Zoom Links</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5>Zoom Links for {{ $course->name }}</h5>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadZoomLinkModal">Add New Zoom Link</button>
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
                                <th>Zoom Link</th>
                                <th>Batches</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($zoomLinks as $zoomLink)
                                <tr>
                                    <td>{{ $zoomLink->zoom_link_id }}</td>
                                    <td>{{ $zoomLink->week_name }}</td>
                                    <td>{{ $zoomLink->description ?? 'No Description' }}</td>
                                    <td><a href="{{ $zoomLink->zoom_link }}" target="_blank">Open Zoom Meeting</a></td>
                                    <td>
                                        @foreach ($zoomLink->batches as $batch)
                                            <span class="badge bg-info">{{ $batch->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editZoomLinkModal{{ $zoomLink->zoom_link_id }}">Edit</button>

                                        <form action="{{ route('coursesZoomLinks.destroy', $zoomLink->zoom_link_id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editZoomLinkModal{{ $zoomLink->zoom_link_id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('coursesZoomLinks.update', $zoomLink->zoom_link_id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Zoom Link</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Week/Name</label>
                                                        <input type="text" name="week_name" class="form-control" value="{{ $zoomLink->week_name }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Zoom Link</label>
                                                        <input type="url" name="zoom_link" class="form-control" value="{{ $zoomLink->zoom_link }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Description</label>
                                                        <textarea name="description" class="form-control">{{ $zoomLink->description }}</textarea>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Batches</label>
                                                        <div class="row">
                                                            @foreach ($course->batches as $batch)
                                                                <div class="col-md-6">
                                                                    <div class="form-check">
                                                                        <input type="checkbox" name="batches[]" value="{{ $batch->id }}" class="form-check-input"
                                                                            id="editbatch{{ $zoomLink->zoom_link_id }}_{{ $batch->id }}"
                                                                            {{ $zoomLink->batches->contains('id', $batch->id) ? 'checked' : '' }}>
                                                                        <label for="editbatch{{ $zoomLink->zoom_link_id }}_{{ $batch->id }}" class="form-check-label">
                                                                            {{ $batch->name }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-primary" type="submit">Save</button>
                                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Upload Zoom Link Modal -->
<div class="modal fade" id="uploadZoomLinkModal" tabindex="-1" aria-labelledby="uploadZoomLinkModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('coursesZoomLinks.store', ['courseId' => $course->course_id]) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New Zoom Link</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Week/Name</label>
                        <input type="text" name="week_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Zoom Link</label>
                        <input type="url" name="zoom_link" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Assign to Batches</label>
                        <div class="row">
                            @foreach($course->batches as $batch)
                                <div class="col-md-6">
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
                    <button class="btn btn-primary" type="submit">Save Zoom Link</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
