@extends('AdminDashboard.master')

@section('title', 'Pending Booking Requests')

@section('breadcrumb-title')
    <h3>Pending Bookings</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Bookings</li>
    <li class="breadcrumb-item active">Pending</li>
@endsection

@section('content')
<div class="container-fluid">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mt-3">
        <div class="card-header">
            <h5>Pending Booking Requests</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Course</th>
                            <th>Contact Number</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $index => $booking)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $booking->customer->name ?? 'N/A' }}</td>
                                <td>{{ $booking->course->name ?? 'N/A' }}</td>
                                <td>{{ $booking->customer->contact_number ?? 'N/A' }}</td>
                                <td>{{ $booking->payment_method }}<br>
                                    @if($booking->payment_status === 'half')
                                        <small class="text-warning">First Payment</small>
                                    @else
                                        <small class="text-success">Full Payment</small>
                                    @endif
                                </td>
                                <td><span class="badge bg-warning">{{ $booking->status }}</span></td>
                                <td class="d-flex gap-2">
                                    <!-- Approve -->
                                    <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST" onsubmit="return confirm('Approve this booking?');">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                    </form>

                                    <!-- View More -->
                                    <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-sm btn-info">View</a>

                                    <!-- Delete -->
                                    <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this booking?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No pending bookings found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection