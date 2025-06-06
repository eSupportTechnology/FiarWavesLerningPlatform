@extends('AdminDashboard.master')

@section('title', 'Pending Withdrawals')

@section('breadcrumb-title')
    <h3>Pending Withdrawals</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Withdrawals</li>
    <li class="breadcrumb-item active">Pending</li>
@endsection

@section('content')
    <div class="container-fluid">

        <div class="card mt-3">
            <div class="card-header">
                <h5>Pending Withdrawal Requests</h5>
            </div>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Requested At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($withdrawals as $index => $withdrawal)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $withdrawal->customer->name ?? 'N/A' }}</td>
                                    <td>{{ number_format($withdrawal->amount, 2) }}</td>
                                    <td><span class="badge bg-warning text-dark">{{ ucfirst($withdrawal->status) }}</span>
                                    </td>
                                    <td>{{ $withdrawal->created_at->format('d M Y, h:i A') }}</td>
                                    <td class="d-flex flex-wrap gap-2">
                                        <!-- Approve -->
                                        <form action="{{ route('admin.withdrawals.approve', $withdrawal->id) }}"
                                            method="POST" onsubmit="return confirm('Approve this withdrawal?');">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                        </form>

                                        <!-- Reject -->
                                        <form action="{{ route('admin.withdrawals.reject', $withdrawal->id) }}"
                                            method="POST" onsubmit="return confirm('Reject this withdrawal?');">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                        </form>

                                        <!-- View Bank Details -->
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#bankDetailsModal{{ $withdrawal->id }}">
                                            Bank Details
                                        </button>

                                        <!-- View More -->
                                        <a href="{{ route('admin.withdrawals.show', $withdrawal->id) }}"
                                            class="btn btn-sm btn-info">View</a>
                                    </td>
                                </tr>

                                <!-- Modal for Bank Details -->
                                <div class="modal fade" id="bankDetailsModal{{ $withdrawal->id }}" tabindex="-1"
                                    aria-labelledby="bankDetailsLabel{{ $withdrawal->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="bankDetailsLabel{{ $withdrawal->id }}">
                                                    Bank Details - {{ $withdrawal->customer->name ?? 'Customer' }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Bank Name:</strong> {{ $withdrawal->bank_name ?? 'N/A' }}</p>
                                                <p><strong>Account Name:</strong> {{ $withdrawal->account_name ?? 'N/A' }}
                                                </p>
                                                <p><strong>Account Number:</strong>
                                                    {{ $withdrawal->account_number ?? 'N/A' }}</p>
                                                <p><strong>Branch:</strong> {{ $withdrawal->bank_branch ?? 'N/A' }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No pending withdrawal requests found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
