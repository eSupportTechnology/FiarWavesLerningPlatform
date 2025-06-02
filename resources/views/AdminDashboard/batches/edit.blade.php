@extends('AdminDashboard.master')

@section('title', 'Edit Batch')

@section('breadcrumb-title')
    <h3>Edit Batch</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.batches.index') }}">Batches</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Edit Batch - {{ $batch->name }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.batches.update', $batch->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="course_id" class="form-label">Course</label>
                    <select name="course_id" class="form-control" required>
                        @foreach($courses as $course)
                            <option value="{{ $course->course_id }}" {{ $batch->course_id == $course->course_id ? 'selected' : '' }}>
                                {{ $course->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Batch Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $batch->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" name="start_date" class="form-control" value="{{ $batch->start_date }}" required>
                </div>

                <div class="text-end">
                    <a href="{{ route('admin.batches.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success">Update Batch</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
