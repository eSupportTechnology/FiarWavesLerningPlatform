@extends('AdminDashboard.master')

@section('title', 'Rejected Withdrawals')

@section('breadcrumb-title')
    <h3>Rejected Withdrawals</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Withdrawals</li>
    <li class="breadcrumb-item active">Rejected</li>
@endsection

@section('content')
<div class="container-fluid">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mt-3">
        <div class="card-header">
            <h5>All Rejected Withdrawals</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Bank Details</th>
                            <th>Rejected At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($withdrawals as $index => $withdrawal)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $withdrawal->customer->name ?? 'N/A' }}</td>
                                <td>Rs. {{ number_format($withdrawal->amount, 2) }}</td>
                                <td><span class="badge bg-danger">{{ ucfirst($withdrawal->status) }}</span></td>
                                <td>
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#bankDetailsModal{{ $withdrawal->id }}">
                                        View
                                    </button>

                                    <!-- Bank Details Modal -->
                                    @include('AdminDashboard.withdraw.partials.bank_modal', ['withdrawal' => $withdrawal])
                                </td>
                                <td>{{ $withdrawal->updated_at ? $withdrawal->updated_at->format('d M Y h:i A') : '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.withdrawals.show', $withdrawal->id) }}" class="btn btn-sm btn-secondary">Details</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No rejected withdrawals found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
