@extends('StudentDashboard.master')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Wallet History</h2>

    @if ($walletTransaction->isEmpty())
        <div class="alert alert-info">
            You have no wallet history yet.
        </div>
    @else
        <div class="table-responsive">
            <form method="GET" action="{{ route('student.wallet.history') }}" class="mb-3">
                <div class="row g-2 align-items-center">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Search by amount, type, status or date (YYYY-MM-DD)"
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-auto">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <a href="{{ route('student.wallet.history') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>

            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Amount (LKR)</th>
                        <th>Transaction Type</th>
                        <th>Transaction Date</th>
                        <th>Transaction Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($walletTransaction as $index => $transaction)
                        <tr>
                            <td>{{ $walletTransaction->firstItem() + $index }}</td>
                            <td>{{ number_format($transaction->amount, 2) }}</td>
                            <td>{{ $transaction->transaction_type }}</td>
                            <td>{{ $transaction->transaction_date->format('Y-m-d H:i A') }}</td>
                            <td>{{ $transaction->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                <div>
                    <small>
                        Showing
                        @if ($walletTransaction->total() > 0)
                            {{ $walletTransaction->firstItem() }} to {{ $walletTransaction->lastItem() }} of
                            {{ $walletTransaction->total() }} entries
                        @else
                            0 entries
                        @endif
                    </small>
                </div>
                <div>
                    {{ $walletTransaction->links('pagination::bootstrap-5') }}
                </div>
            </div>

        </div>
    @endif
</div>
@endsection
