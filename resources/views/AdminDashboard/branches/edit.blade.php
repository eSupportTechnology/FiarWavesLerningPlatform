@extends('AdminDashboard.master')
@section('title', 'Edit Branch')

@section('content')
<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-header"><h5>Edit Branch</h5></div>
        <div class="card-body">
            <form action="{{ route('branches.update', $branch->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Branch Name</label>
                    <input type="text" name="name" value="{{ $branch->name }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" value="{{ $branch->address }}" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" value="{{ $branch->phone }}" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('branches.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection
