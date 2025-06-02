@extends('AdminDashboard.master')

@section('title', 'Edit Review')

@section('breadcrumb-title')
    <h3>Edit Review</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.reviews.index') }}">Reviews</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="container-fluid">

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error!</strong> Please check the form below.<br><br>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5>Edit Review - {{ $review->student_name }}</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.reviews.update', $review->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    <div class="col-md-6">
                        <label for="student_name" class="form-label">Student Name</label>
                        <input type="text" name="student_name" class="form-control" value="{{ old('student_name', $review->student_name) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="rating" class="form-label">Rating</label>
                        <select name="rating" class="form-control" required>
                            @for ($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" {{ $review->rating == $i ? 'selected' : '' }}>
                                    {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="approved" {{ $review->status == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="pending" {{ $review->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label for="comment" class="form-label">Comment</label>
                        <textarea name="comment" class="form-control" rows="4" required>{{ old('comment', $review->comment) }}</textarea>
                    </div>

                    <div class="col-12">
                        <label for="image" class="form-label">Upload Image (optional)</label>
                        <input type="file" name="image" class="form-control">
                        @if ($review->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $review->image) }}" width="80" class="rounded">
                            </div>
                        @endif
                    </div>

                    <div class="col-12 text-end">
                        <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-success">Update Review</button>
                    </div>

                </div>
            </form>
        </div>
    </div>

</div>
@endsection
