@extends('AdminDashboard.master')

@section('title', 'Create VIP Package')

@section('breadcrumb-title')
    <h3>Add VIP Package</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Packages</li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Create New Package</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('vip-packages.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Package Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Price (Rs) <span class="text-danger">*</span></label>
                    <input type="number" name="price" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="4" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image (optional)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="active" selected>Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Video Link (optional)</label>
                    <input type="url" name="video_link" class="form-control" placeholder="https://youtube.com/..." value="{{ old('video_link') }}">
                </div>


                <div class="text-end">
                    <button class="btn btn-success">Save Package</button>
                    <a href="{{ route('vip-packages.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
