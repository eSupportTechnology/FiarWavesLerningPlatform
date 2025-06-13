@extends('StudentDashboard.master')

@section('title', 'Withdraw Funds')

@section('content')

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


    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow-lg border-0">
                    <div class="card-header bg-success text-white text-center">
                        <h4>Withdraw Request</h4>
                    </div>

                    <div class="card-body">
                        @php
                            use Carbon\Carbon;

                            $currentDay = Carbon::now()->format('l'); // Full day name, e.g., 'Monday'
                            $allowedDays = ['Thursday', 'Friday', 'Saturday'];
                            $isWithdrawDay = in_array($currentDay, $allowedDays);
                        @endphp
                        @if ($isWithdrawDay  && $wallet->balance > 0)
                            <form action="{{ route('student.withdraw.submit') }}" method="POST">
                                @csrf

                                <p class="mb-3">You're eligible for a withdrawal.</p>

                                <div class="mb-3">
                                    <label class="form-label">Amount</label>
                                    <input type="text" name="amount" class="form-control" value="{{ $wallet->balance }}"
                                        readonly>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Bank Transfer Details</label>
                                    <textarea class="form-control" rows="5" readonly>
Bank Name: {{ $customer->bank_name }}
Branch: {{ $customer->bank_branch }}
Account Name: {{ $customer->account_name }}
Account Number: {{ $customer->account_number }}
                                </textarea>
                                </div>

                                <div class="alert alert-warning text-sm">
                                    Please check your bank details carefully before confirming withdrawal.
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success">Submit Withdrawal</button>
                                </div>
                                @error('amount')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </form>
                        @else
                            <div class="alert alert-warning text-center">
                                You are not eligible to withdraw at this time.
                            </div>
                        @endif
                    </div>

                    <div class="card-footer text-muted text-center">
                        Withdrawals are processed weekly. Ensure your bank details are correct before submission.
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
