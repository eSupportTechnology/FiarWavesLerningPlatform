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
                            <td>{{ $index + 1 }}</td>
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
        </div>
    @endif
</div>
@endsection
