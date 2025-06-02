@extends('AdminDashboard.master')

@section('title', 'Manage Banners')

@section('breadcrumb-title')
    <h3>Manage Banners</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Settings</li>
    <li class="breadcrumb-item active">Banners</li>
@endsection

@section('content')
<div class="container-fluid">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>There were some problems with your input:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Banner Form (Create / Update) -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>{{ isset($bannerToEdit) ? 'Edit Banner' : 'Add New Banner' }}</h5>
        </div>
        <div class="card-body">
            <form 
                action="{{ isset($bannerToEdit) ? route('admin.banners.update', $bannerToEdit->id) : route('admin.banners.store') }}" 
                method="POST" 
                enctype="multipart/form-data"
            >
                @csrf
                @if (isset($bannerToEdit))
                    @method('PUT')
                @endif

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Banner Image <small>(Max: 10MB)</small></label>
                        <input type="file" name="image" class="form-control" {{ isset($bannerToEdit) ? '' : 'required' }}>
                        
                        @if (isset($bannerToEdit) && $bannerToEdit->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $bannerToEdit->image) }}" width="100" class="img-thumbnail">
                            </div>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Redirect Link (optional)</label>
                        <input 
                            type="url" 
                            name="link" 
                            class="form-control" 
                            value="{{ old('link', $bannerToEdit->link ?? '') }}"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="1" {{ (old('status', $bannerToEdit->status ?? '') == 1) ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ (old('status', $bannerToEdit->status ?? '') == 0) ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="col-12 text-end">
                        @if (isset($bannerToEdit))
                            <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-warning">Update</button>
                        @else
                            <button type="submit" class="btn btn-success">Create Banner</button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Banner List Table -->
    <div class="card">
        <div class="card-header">
            <h5>All Banners</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered text-center">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Preview</th>
                        <th>Link</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($banners as $index => $banner)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $banner->image) }}" width="150" class="img-thumbnail">
                            </td>
                            <td>
                                @if ($banner->link)
                                    <a href="{{ $banner->link }}" target="_blank">{{ $banner->link }}</a>
                                @else
                                    <span class="text-muted">No link</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ $banner->status ? 'success' : 'secondary' }}">
                                    {{ $banner->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="d-flex justify-content-center gap-2 flex-wrap">
                                <a href="#" 
                                    class="btn btn-sm btn-info" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editModal{{ $banner->id }}">
                                    Edit
                                </a>

                                <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('Delete this banner?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5">No banners added yet.</td></tr>
                    @endforelse



                    
                </tbody>

                
            </table>

            @foreach($banners as $banner)
<!-- Edit Modal -->
<div class="modal fade" id="editModal{{ $banner->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $banner->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data" class="modal-content">
        @csrf
        @method('PUT')

        <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel{{ $banner->id }}">Edit Banner</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body row g-3">
            <div class="col-md-6">
                <label class="form-label">Banner Image</label>
                <input type="file" name="image" class="form-control">
                @if ($banner->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $banner->image) }}" width="100" class="img-thumbnail">
                    </div>
                @endif
            </div>

            <div class="col-md-6">
                <label class="form-label">Redirect Link</label>
                <input type="url" name="link" class="form-control" value="{{ $banner->link }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="1" {{ $banner->status ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$banner->status ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-warning">Update</button>
        </div>
    </form>
  </div>
</div>
@endforeach


            <div class="mt-3">
                {{ $banners->links() }} {{-- Pagination --}}
            </div>
        </div>
    </div>
</div>
@endsection
