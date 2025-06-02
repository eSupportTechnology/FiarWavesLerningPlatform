@extends('AdminDashboard.master')

@section('title', 'VIP Packages')

@section('breadcrumb-title')
    <h3>VIP Packages</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Packages</li>
    <li class="breadcrumb-item active">All</li>
@endsection

@section('content')
<div class="container-fluid">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>All VIP Packages</h5>
            <a href="{{ route('vip-packages.create') }}" class="btn btn-primary">+ Add New</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Price (Rs)</th>
                            <th>Video Link</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($packages as $index => $package)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if($package->image)
                                        <img src="{{ asset('storage/' . $package->image) }}" width="70">
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>
                                <td>{{ $package->title }}</td>
                                <td>{{ number_format($package->price) }}</td>
                                <td>
                                            @if($package->video_link)
                                                <a href="{{ $package->video_link }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                    View Video
                                                </a>
                                            @else
                                                <span class="text-muted">No Video</span>
                                            @endif
                                        </td>
                                <td>
                                    <span class="badge bg-{{ $package->status === 'active' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($package->status) }}
                                    </span>
                                </td>
                                <td class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('vip-packages.edit', $package->id) }}" class="btn btn-sm btn-info">Edit</a>
                                    <form action="{{ route('vip-packages.destroy', $package->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6">No VIP packages found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
