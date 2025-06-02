@extends('AdminDashboard.master')

@section('title', 'Manage Blogs')

@section('breadcrumb-title')
    <h3>Manage Blogs</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Content</li>
    <li class="breadcrumb-item active">Blogs</li>
@endsection

@section('content')
<div class="container-fluid">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>All Blogs</h5>
            <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">+ Add New Blog</a>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Media</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($blogs as $index => $blog)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ Str::limit($blog->title, 50) }}</td>
                            <td>
                                @if($blog->media_type === 'image' && $blog->media_path)
                                    <img src="{{ asset('storage/' . $blog->media_path) }}" width="100" class="img-thumbnail">
                                @elseif($blog->media_type === 'video' && $blog->media_path)
                                    <video width="150" controls>
                                        <source src="{{ asset('storage/' . $blog->media_path) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @else
                                    <span class="text-muted">No Media</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ $blog->status ? 'success' : 'secondary' }}">
                                    {{ $blog->status ? 'Published' : 'Unpublished' }}
                                </span>
                            </td>
                            <td>{{ $blog->created_at->format('d M Y') }}</td>
                            <td class="d-flex justify-content-center gap-2 flex-wrap">
                                <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Delete this blog?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6">No blogs found.</td></tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $blogs->links() }} {{-- Laravel pagination --}}
            </div>
        </div>
    </div>
</div>
@endsection
