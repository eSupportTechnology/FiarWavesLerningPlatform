@extends('AdminDashboard.master')

@section('title', 'Approved Withdrawals')

@section('breadcrumb-title')
    <h3>Approved Withdrawals</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Withdrawals</li>
    <li class="breadcrumb-item active">Approved</li>
@endsection

@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card mt-3">
            <div class="card-header">
                <h5>All Approved Withdrawals</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <form method="GET" action="{{ route('admin.withdrawals.approved') }}" class="mb-3">
                        <div class="row g-2 align-items-center">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control"
                                    placeholder="Search by name, email or contact" value="{{ request('search') }}">
                            </div>
                            <div class="col-md-auto">
                                <button type="submit" class="btn btn-primary">Search</button>
                                <a href="{{ route('admin.withdrawals.approved') }}" class="btn btn-secondary">Reset</a>
                            </div>
                        </div>
                    </form>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Bank Details</th>
                                <th>Approved At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($withdrawals as $index => $withdrawal)
                                <tr>
                                    <td>{{ $withdrawals->firstItem() + $index }}</td>
                                    <td>{{ $withdrawal->customer->name ?? 'N/A' }}</td>
                                    <td>Rs. {{ number_format($withdrawal->amount, 2) }}</td>
                                    <td><span class="badge bg-success">{{ ucfirst($withdrawal->status) }}</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                            data-bs-target="#bankDetailsModal{{ $withdrawal->id }}">
                                            View
                                        </button>

                                        <!-- Bank Details Modal -->
                                        @include('AdminDashboard.withdraw.partials.bank_modal', [
                                            'withdrawal' => $withdrawal,
                                        ])
                                    </td>
                                    <td>{{ $withdrawal->updated_at ? $withdrawal->updated_at->format('d M Y h:i A') : '-' }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.withdrawals.show', $withdrawal->id) }}"
                                            class="btn btn-sm btn-secondary">Details</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No approved withdrawals found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    @if ($withdrawals->hasPages())
                        <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                            <div>
                                <small>
                                    Showing {{ $withdrawals->firstItem() }} to {{ $withdrawals->lastItem() }} of
                                    {{ $withdrawals->total() }} entries
                                </small>
                            </div>
                            <div>
                                {{ $withdrawals->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
