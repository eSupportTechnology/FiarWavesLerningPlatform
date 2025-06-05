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
                        @if (
                            $customer &&
                                $customer->is_first_time_withdrawal == 0 &&
                                $customer->left_side_points >= 1 &&
                                $customer->right_side_points >= 1)
                            <form action="{{ route('student.withdraw.submit') }}" method="POST">
                                @csrf

                                <p class="mb-3">You're eligible for your <strong>first withdrawal</strong>.</p>

                                <div class="mb-3">
                                    <label class="form-label">Amount</label>
                                    <input type="text" name="amount" class="form-control" value="1000" readonly>
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
                                    <button type="submit" class="btn btn-success">Confirm Withdrawal</button>
                                </div>
                            </form>
                        @elseif (
                            $customer &&
                                $customer->is_first_time_withdrawal == 1 &&
                                $customer->left_side_points >= 2 &&
                                $customer->right_side_points >= 2)
                            @php
                            $eligiblePoints = min($customer->left_side_points, $customer->right_side_points);
                            $eligiblePoints = $eligiblePoints - ($eligiblePoints % 2); // Round down to nearest even
                            $maxAmount = $eligiblePoints * 1000;

                            if ($maxAmount > 12000) {
                                $eligiblePoints = 24; // 12 + 12 points
                                $maxAmount = 12000;
                            }
                        @endphp

                            <form action="{{ route('student.withdraw.submit') }}" method="POST">
                                @csrf

                                <p class="mb-3">You're eligible for a withdrawal.</p>

                                <div class="mb-3">
                                    <label class="form-label">Amount</label>
                                    <input type="text" name="amount" class="form-control" value="{{ $maxAmount }}" readonly>
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
                                @error('amount') <small class="text-danger">{{ $message }}</small> @enderror
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
