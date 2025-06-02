@extends('AdminDashboard.master')

@section('title', 'Create New Batch')

@section('breadcrumb-title')
    <h3>Create Batch</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.batches.index') }}">Batches</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Add New Batch</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.batches.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="course_id" class="form-label">Course</label>
                    <select name="course_id" class="form-control" required>
                        <option value="">Select Course</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->course_id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Batch Name</label>
                    <input type="text" name="name" class="form-control" placeholder="E.g., Batch 01" required>
                </div>

                <div class="mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" name="start_date" class="form-control" required>
                </div>

                <div class="text-end">
                    <a href="{{ route('admin.batches.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Create Batch</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
