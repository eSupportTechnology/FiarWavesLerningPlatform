@extends('AdminDashboard.master')

@section('title', 'Withdrawal Details')

@section('breadcrumb-title')
    <h3>Withdrawal Details</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.withdrawals.pending') }}">Withdrawals</a></li>
    <li class="breadcrumb-item active">Details</li>
@endsection

@section('content')
<div class="container">
    <div class="card mt-3">
        <div class="card-header">
            <h5>Details for Withdrawal #{{ $withdrawal->id }}</h5>
        </div>
        <div class="card-body">
            <p><strong>Customer:</strong> {{ $withdrawal->customer->name ?? 'N/A' }}</p>
            <p><strong>Amount:</strong> {{ number_format($withdrawal->amount, 2) }}</p>
            <p><strong>Status:</strong> <span class="badge bg-secondary">{{ ucfirst($withdrawal->status) }}</span></p>
            <p><strong>Requested At:</strong> {{ $withdrawal->created_at->format('d M Y, h:i A') }}</p>
            <p><strong>Bank Name:</strong> {{ $withdrawal->bank_name ?? 'N/A' }}</p>
            <p><strong>Account Name:</strong> {{ $withdrawal->account_name ?? 'N/A' }}</p>
            <p><strong>Account Number:</strong> {{ $withdrawal->account_number ?? 'N/A' }}</p>
            <p><strong>Branch:</strong> {{ $withdrawal->bank_branch ?? 'N/A' }}</p>
        </div>
    </div>
</div>
@endsection
