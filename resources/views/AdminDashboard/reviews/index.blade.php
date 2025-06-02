@extends('AdminDashboard.master')

@section('title', 'Course Reviews')

@section('breadcrumb-title')
    <h3>Course Reviews</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Feedback</li>
    <li class="breadcrumb-item active">Reviews</li>
@endsection

@section('content')
<div class="container-fluid">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>All Reviews</h5>
            <a href="{{ route('admin.reviews.create') }}" class="btn btn-primary">+ Add Review</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Student</th>
                            <th>Rating</th>
                            <th>Comment</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reviews as $index => $review)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $review->student_name }}</td>
                                <td>
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fa fa-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                                    @endfor
                                </td>
                                <td>{{ \Illuminate\Support\Str::limit($review->comment, 50) }}</td>
                                <td>
                                    @if($review->image)
                                        <img src="{{ asset('storage/' . $review->image) }}" width="60" class="rounded">
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-{{ $review->status === 'approved' ? 'success' : 'warning' }}">
                                        {{ ucfirst($review->status) }}
                                    </span>
                                </td>
                                <td class="d-flex flex-wrap justify-content-center gap-2">
                                    <form action="{{ route('admin.reviews.toggleStatus', $review->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-{{ $review->status === 'approved' ? 'warning' : 'success' }}">
                                            {{ $review->status === 'approved' ? 'Deactivate' : 'Approve' }}
                                        </button>
                                    </form>

                                    <a href="{{ route('admin.reviews.edit', $review->id) }}" class="btn btn-sm btn-info">Edit</a>

                                    <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this review?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">No reviews found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $reviews->links() }} <!-- Pagination if you're using paginate() -->
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
