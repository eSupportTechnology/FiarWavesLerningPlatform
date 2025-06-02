<!-- resources/views/AdminDashboard/batches/index.blade.php -->
@extends('AdminDashboard.master')

@section('title', 'Batches')

@section('breadcrumb-title')
    <h3>All Batches</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Course Management</li>
    <li class="breadcrumb-item active">Batches</li>
@endsection

@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>Batch List</h5>
            <a href="{{ route('admin.batches.create') }}" class="btn btn-primary">+ Add Batch</a>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Course</th>
                        <th>Batch Name</th>
                        <th>Start Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($batches as $index => $batch)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $batch->course->name ?? 'N/A' }}</td>
                        <td>{{ $batch->name }}</td>
                        <td>{{ $batch->start_date }}</td>
                        <td>
                            <a href="{{ route('admin.batches.edit', $batch->id) }}" class="btn btn-sm btn-info">Edit</a>
                            <form action="{{ route('admin.batches.destroy', $batch->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
