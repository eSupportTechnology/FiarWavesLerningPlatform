@extends('AdminDashboard.master')

@section('title', 'Edit Employee')

@section('breadcrumb-title')
    <h3>Edit Employee</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Employees</li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0">Update Employee</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.employees.update', $employee->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $employee->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $employee->email) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                            <select name="role" class="form-control" required>
                                <option value="admin" {{ $employee->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="manager" {{ $employee->role === 'manager' ? 'selected' : '' }}>Manager</option>
                                <option value="staff" {{ $employee->role === 'staff' ? 'selected' : '' }}>Staff</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">New Password <small class="text-muted">(Leave blank to keep current password)</small></label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success px-4">Update</button>
                            <a href="{{ route('admin.employees.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
