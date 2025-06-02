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

                                            <!-- New Buttons for Files, Recordings, Zoom Links -->
                                            <a href="{{ route('courseFile.second', $course->course_id) }}" class="btn btn-success btn-sm">Files</a>
                                            <a href="{{ route('coursesRecording.index', $course->course_id) }}" class="btn btn-secondary btn-sm">Recordings</a>
                                            <a href="{{ route('coursesZoomLinks.index', $course->course_id) }}" class="btn btn-dark btn-sm">Zoom Links</a>

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
