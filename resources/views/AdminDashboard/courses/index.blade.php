@extends('AdminDashboard.master')
@section('title', 'All Courses')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>All Courses</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Course Management</li>
    <li class="breadcrumb-item active">All Courses</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Course List</h5>
                        <a href="{{ route('courses.create') }}" class="btn btn-primary">Add New Course</a>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}</div>
                        @endif

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Course Name</th>
                                    <th>Duration (Days)</th>
                                    <th>Total Price (Rs.)</th>
                                    <th>First Payment (Rs.)</th>
                                    <th>Video</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    <tr>
                                        <td>{{ $course->course_id }}</td>
                                        <td>
                                            @if ($course->image)
                                                <img src="{{ asset($course->image) }}" alt="Course Image" width="70" height="70" align="center">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>{{ $course->name }}</td>
                                        <td>{{ $course->duration }}</td>
                                        <td>{{ $course->total_price }}</td>
                                        <td>{{ $course->first_payment }}</td>
                                        <td>
                                            @if($course->video_link)
                                                <a href="{{ $course->video_link }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                    View Video
                                                </a>
                                            @else
                                                <span class="text-muted">No Video</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('courses.show', $course->course_id) }}" class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('courses.edit', $course->course_id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('courses.destroy', $course->course_id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
