@extends('AdminDashboard.master')

@section('title', 'Edit VIP Package')

@section('breadcrumb-title')
    <h3>Edit VIP Package</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('vip-packages.index') }}">VIP Packages</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5>Edit Package: <strong>{{ $vipPackage->title }}</strong></h5>
        </div>

        <div class="card-body">
            <form action="{{ route('vip-packages.update', $vipPackage->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="form-group mb-3">
                    <label>Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $vipPackage->title) }}" required>
                </div>

                <!-- Price -->
                <div class="form-group mb-3">
                    <label>Price (Rs.) <span class="text-danger">*</span></label>
                    <input type="number" name="price" class="form-control" value="{{ old('price', $vipPackage->price) }}" required>
                </div>

                <!-- Description -->
                <div class="form-group mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description', $vipPackage->description) }}</textarea>
                </div>

                <!-- Current Image -->
                @if($vipPackage->image)
                <div class="form-group mb-3">
                    <label>Current Image:</label><br>
                    <img src="{{ asset('storage/' . $vipPackage->image) }}" width="120" class="img-thumbnail">
                </div>
                @endif

                <!-- Image Upload -->
                <div class="form-group mb-3">
                    <label>Upload New Image</label>
                    <input type="file" name="image" class="form-control">
                    <small class="text-muted">Leave blank to keep current image.</small>
                </div>

                <!-- Video Link -->
                <div class="form-group mb-3">
                    <label>Video Link (optional)</label>
                    <input type="url" name="video_link" class="form-control" placeholder="https://youtube.com/..." value="{{ old('video_link', $vipPackage->video_link) }}">
                </div>


                <!-- Status -->
                <div class="form-group mb-4">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="active" {{ $vipPackage->status === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $vipPackage->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <!-- Submit -->
                <div class="form-group text-center">
                    <button class="btn btn-success">Update Package</button>
                    <a href="{{ route('vip-packages.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
