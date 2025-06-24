@extends('StudentDashboard.master')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Withdrawal History</h2>

    @if ($withdrawals->isEmpty())
        <div class="alert alert-info">
            You have no withdrawal history yet.
        </div>
    @else
        <div class="table-responsive">
            <form method="GET" action="{{ route('student.allPayments') }}" class="mb-3">
                <div class="row g-2 align-items-center">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Search by amount, status or date (YYYY-MM-DD)"
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-auto">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <a href="{{ route('student.allPayments') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>

            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Amount (LKR)</th>
                        <th>Requested At</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($withdrawals as $index => $withdrawal)
                        <tr>
                            <td>{{ $withdrawals->firstItem() + $index }}</td>
                            <td>{{ number_format($withdrawal->amount, 2) }}</td>

                            <td>{{ $withdrawal->created_at->format('Y-m-d H:i A') }}</td>
                            <td>
                                @if ($withdrawal->status === 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif ($withdrawal->status === 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @elseif ($withdrawal->status === 'rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($withdrawal->status) }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                <div>
                    <small>
                        Showing
                        @if ($withdrawals->total() > 0)
                            {{ $withdrawals->firstItem() }} to {{ $withdrawals->lastItem() }} of
                            {{ $withdrawals->total() }} entries
                        @else
                            0 entries
                        @endif
                    </small>
                </div>
                <div>
                    {{ $withdrawals->links('pagination::bootstrap-5') }}
                </div>
            </div>

        </div>
    @endif
</div>
@endsection
