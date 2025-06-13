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
                            <td>{{ $index + 1 }}</td>
                            <td>{{ number_format($transaction->amount, 2) }}</td>
                            <td>{{ $transaction->transaction_type }}</td>
                            <td>{{ $transaction->transaction_date->format('Y-m-d H:i A') }}</td>
                            <td>{{ $transaction->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
