@extends('AdminDashboard.master')
@section('title', 'Add Branch')

@section('content')
<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-header"><h5>Add Branch</h5></div>
        <div class="card-body">
            <form action="{{ route('branches.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Branch Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">Save</button>
                <a href="{{ route('branches.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection
