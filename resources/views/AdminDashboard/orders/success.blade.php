@extends('AdminDashboard.master')

@section('title', 'Successful Orders')

@section('breadcrumb-title')
    <h3>Successful Orders</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Orders</li>
    <li class="breadcrumb-item active">Success</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Confirmed Course Bookings</h5>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Student</th>
                        <th>Course</th>
                        <th>Payment</th>
                        <th>Method</th>
                        <th>Transfer Date</th>
                        <th>View</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bookings as $index => $booking)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $booking->customer->name ?? 'N/A' }}</td>
                            <td>{{ $booking->course->name ?? 'N/A' }}</td>
                            <td>{{ ucfirst($booking->payment_status) }}</td>
                            <td>{{ $booking->payment_method }}</td>
                            <td>{{ $booking->transfer_date ?? 'N/A' }}</td>
                            <td>
                                @if($booking->receipt_path)
                                    <a href="{{ route('admin.orders.show', $booking->id) }}" class="btn btn-sm btn-info">View</a>
                                @else
                                    <span class="text-muted">No Receipt</span>
                                @endif
                            </td>
                            <td><span class="badge bg-success">{{ $booking->status }}</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No successful orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
