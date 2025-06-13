@extends('StudentDashboard.master')

@section('title', 'Dashboard')

@section('content')

    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">

                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a>
                                <svg class="stroke-icon">
                                    <use href="{{ asset('backend/assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item active">Default </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    {{-- <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row widget-grid">
            <div class="col-xxl-4 col-sm-6 box-col-6">
                <div class="card profile-box">
                    <div class="card-body">
                        <div class="media media-wrapper justify-content-between">
                            <div class="media-body">
                                <div class="greeting-user">
                                    <h4 class="f-w-600">Welcome to DHA Academy</h4>
                                    <p>Here whats happing in your account today</p>
                                    <div class="whatsnew-btn"><a class="btn btn-outline-white">Whats New !</a></div>
                                </div>
                            </div>
                            <div>
                                <div class="clockbox">
                                    <svg id="clock" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600">
                                        <g id="face">
                                            <circle class="circle" cx="300" cy="300" r="253.9"></circle>
                                            <path class="hour-marks"
                                                d="M300.5 94V61M506 300.5h32M300.5 506v33M94 300.5H60M411.3 107.8l7.9-13.8M493 190.2l13-7.4M492.1 411.4l16.5 9.5M411 492.3l8.9 15.3M189 492.3l-9.2 15.9M107.7 411L93 419.5M107.5 189.3l-17.1-9.9M188.1 108.2l-9-15.6">
                                            </path>
                                            <circle class="mid-circle" cx="300" cy="300" r="16.2"></circle>
                                        </g>
                                    </svg>
                                </div>
                                <div class="badge f-10 p-0" id="txt"></div>
                            </div>
                        </div>
                        <div class="cartoon"><img class="img-fluid"
                                src="{{ asset('backend/assets/images/dashboard/cartoon.svg') }}"
                                alt="vector women with leptop"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends--> --}}


    <!-- Wallet Card Section (Enhanced Full Width) -->
    <div class="container-fluid mb-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-lg border-0"
                    style="background: linear-gradient(135deg, #4e54c8, #8f94fb); min-height: 130px;">
                    <div class="card-body text-white">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <!-- Wallet Info -->
                            <div class="mb-2">
                                <h3 class="card-title fw-bold mb-1">My Wallet</h3>
                                <p class="mb-0 small text-light">Available Balance</p>
                                @php
                                    $walletBalance = $wallet->balance ?? 0;
                                @endphp
                                <h2 class="fw-bold mt-2">LKR {{ number_format($walletBalance, 2) }}</h2>
                            </div>

                            <!-- Wallet Icon -->
                            <div class="d-flex align-items-center mb-2">
                                <svg width="48" height="48" fill="currentColor"
                                    class="bi bi-wallet2 text-white me-3">
                                    <use href="{{ asset('backend/assets/svg/icon-sprite.svg#wallet') }}"></use>
                                </svg>
                            </div>

                            <!-- Action Buttons -->
                            <div class="text-end mb-2">
                                <a href="{{ route('student.wallet.history') }}"
                                    class="btn btn-outline-light btn-sm me-2 px-3">
                                    View History
                                </a>
                                @php
                                    use Carbon\Carbon;

                                    $currentDay = Carbon::now()->format('l'); // Full day name, e.g., 'Monday'
                                    $allowedDays = ['Thursday', 'Friday', 'Saturday'];
                                    $isWithdrawDay = in_array($currentDay, $allowedDays);
                                @endphp

                                <a href="{{ $isWithdrawDay ? route('student.withdraw') : '#' }}"
                                    class="btn btn-success btn-sm px-3 {{ $isWithdrawDay ? '' : 'disabled' }}"
                                    {{ $isWithdrawDay ? '' : 'aria-disabled=true tabindex=-1' }}>
                                    Withdraw
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Daily Income Section -->
    <div class="container-fluid mb-4">
        <div class="card bg-dark text-white">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h5 class="card-title mb-1">Daily Income (Daily + Active = Daily Income)</h5>
                        @php

                            $activeLeft = $customer->active_left_points ?? 0;
                            $activeRight = $customer->active_right_points ?? 0;

                            $dailyLeft = $customer->left_side_points ?? 0;
                            $dailyRight = $customer->right_side_points ?? 0;

                            $left = $activeLeft + $dailyLeft;
                            $right = $activeRight + $dailyRight;

                            $minPoints = min($left, $right);

                            if ($customer->is_first_time_withdrawal == 0) {
                                // Allow minimum 1
                                if ($minPoints == 1) {
                                    $dailyPoints = 1;
                                } else {
                                    $evenMin = $minPoints % 2 === 0 ? $minPoints : $minPoints - 1;
                                    $dailyPoints = min($evenMin, 12);
                                }
                            } else {
                                // After first withdrawal, minimum must be 2 and even
                                if ($minPoints >= 2) {
                                    $adjusted = $minPoints % 2 == 0 ? $minPoints : $minPoints - 1;
                                    $dailyPoints = min($adjusted, 12);
                                } else {
                                    $dailyPoints = 0;
                                }
                            }
                        @endphp

                        <p class="card-text mb-2">
                            Daily Income - {{ $dailyPoints }} Points = LKR {{ $dailyPoints * 1000 }}
                        </p>




                        @php
                            $dailyIncome = ($dailyPoints ?? 0) * 1000;
                            $progress = min(($dailyIncome / 12000) * 100, 100); // Assuming max 12 points = 12,000 LKR
                        @endphp

                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $progress }}%;"
                                aria-valuenow="{{ $dailyIncome }}" aria-valuemin="0" aria-valuemax="12000">
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6 text-end">
                        <h6 class="mb-0">Daily Maxout - {{ number_format(12000) }} LKR</h6>
                        <p class="mb-0 fs-4 fw-bold">{{ number_format(12000) }} LKR</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Allowance Progress (Circular) -->
    <div class="container-fluid mb-4">
        <div class="card bg-dark text-white">
            <div class="card-body text-center">
                <h5 class="card-title mb-4">Allowance Progress</h5>

                @php
                    $earnedPoints = $dailyPoints ?? 0;
                    $totalPoints = 12;
                    $clampedPoints = min($earnedPoints, $totalPoints);
                    $percentage = round(($clampedPoints / $totalPoints) * 100);
                    $radius = 65;
                    $circumference = 2 * pi() * $radius;
                    $offset = $circumference * (1 - $percentage / 100);
                @endphp

                <div class="d-flex justify-content-center">
                    <div class="position-relative" style="width: 150px; height: 150px;">
                        <svg width="150" height="150" class="position-absolute">
                            <!-- Background circle -->
                            <circle cx="75" cy="75" r="{{ $radius }}" fill="none" stroke="#495057"
                                stroke-width="8" />
                            <!-- Foreground circle (progress) -->
                            <circle cx="75" cy="75" r="{{ $radius }}" fill="none" stroke="#28a745"
                                stroke-width="8" stroke-dasharray="{{ $circumference }}"
                                stroke-dashoffset="{{ $offset }}" stroke-linecap="round"
                                transform="rotate(-90 75 75)" />
                        </svg>
                        <div class="position-absolute top-50 start-50 translate-middle text-white">
                            <h2 class="mb-0">{{ $percentage }}%</h2>
                            <small>{{ $clampedPoints }} / {{ $totalPoints }} pts</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid mb-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title text-center">Invitation Code</h5>
                        <p class="card-text fs-5 fw-bold text-center">{{ $customer->invite_code ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title text-center">Daily Left Side Points</h5>
                        <p class="card-text fs-5 fw-bold text-center">{{ $customer->left_side_points ?? 0 }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <h5 class="card-title text-center">Daily Right Side Points</h5>
                        <p class="card-text fs-5 fw-bold text-center">{{ $customer->right_side_points ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Points Section -->
    <div class="container-fluid mb-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card bg-dark text-white">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Left Side Points</h5>
                        <p class="card-text fs-2 fw-bold text-warning">{{ $customer->total_left_points ?? 0 }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg-dark text-white">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Right Side Points</h5>
                        <p class="card-text fs-2 fw-bold text-warning">{{ $customer->total_right_points ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Used Points Section -->
    <div class="container-fluid mb-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card text-white bg-warning">
                    <div class="card-body text-center">
                        <h5 class="card-title">Used Left Side Points</h5>
                        <p class="card-text fs-3 fw-bold">{{ $customer->used_left_points ?? 0 }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-white bg-warning">
                    <div class="card-body text-center">
                        <h5 class="card-title">Used Right Side Points</h5>
                        <p class="card-text fs-3 fw-bold">{{ $customer->used_right_points ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Points Section -->
    <div class="container-fluid mb-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card text-white bg-success">
                    <div class="card-body text-center">
                        <h5 class="card-title">Active Left Side Points</h5>
                        <p class="card-text fs-3 fw-bold">{{ $customer->active_left_points ?? 0 }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-white bg-success">
                    <div class="card-body text-center">
                        <h5 class="card-title">Active Right Side Points</h5>
                        <p class="card-text fs-3 fw-bold">{{ $customer->active_right_points ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Invitees Section -->
    <div class="container-fluid mb-4">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">Your New Invitees</h5>
            </div>
            <div class="card-body">
                @if ($invitees && $invitees->count() > 0)
                    <ul class="list-group">
                        @foreach ($invitees as $invitee)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $invitee->name ?? 'Unnamed User' }} ({{ $invitee->email ?? 'No email' }})
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#placementModal" data-invitee-id="{{ $invitee->user_id }}">
                                    Place
                                </button>

                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-center text-muted py-4">No invitees found.</div>
                @endif
            </div>
        </div>
    </div>

    <!-- Placement Modal -->
    <div class="modal fade" id="placementModal" tabindex="-1" aria-labelledby="placementModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('invitee.place') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="placementModalLabel">Choose Placement Side</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <!-- This is the fixed hidden input -->
                        <input type="hidden" name="invitee_id" id="modal_invitee_id">

                        <div class="btn-group" role="group" aria-label="Choose Side">
                            <input type="radio" class="btn-check" name="side" id="left_side" value="left"
                                required>
                            <label class="btn btn-outline-success" for="left_side">Left</label>

                            <input type="radio" class="btn-check" name="side" id="right_side" value="right"
                                required>
                            <label class="btn btn-outline-primary" for="right_side">Right</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Confirm Placement</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Section Members (Like in the image) -->
    {{-- <div class="container-fluid mb-4">
        <div class="card bg-dark text-white">
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-6">
                        <h5 class="card-title">Section A Members</h5>
                        <p class="card-text fs-1 fw-bold text-warning">{{ $customer->section_a_members ?? 0 }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="card-title">Section B Members</h5>
                        <p class="card-text fs-1 fw-bold text-warning">{{ $customer->section_b_members ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Active Packages Section -->
    {{-- <div class="container-fluid mb-4">
        <div class="card bg-dark text-white">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h5 class="card-title mb-1">Active Packages</h5>
                        <p class="card-text mb-2">{{ $customer->active_package_name ?? 'Gold Plan' }} - {{ $customer->active_package_amount ?? 500 }} USDT (Earned - {{ $customer->package_earned ?? 365 }} USDT)</p>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-warning" role="progressbar"
                                 style="width: {{ (($customer->package_earned ?? 365) / ($customer->active_package_amount ?? 500)) * 100 }}%;"
                                 aria-valuenow="{{ $customer->package_earned ?? 365 }}"
                                 aria-valuemin="0"
                                 aria-valuemax="{{ $customer->active_package_amount ?? 500 }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        <h6 class="mb-0">Total Package Maxout - {{ $customer->total_package_maxout ?? 1500 }} USDT</h6>
                        <p class="mb-0 fs-4 fw-bold">{{ $customer->total_package_maxout ?? 1500 }} USDT</p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    <!-- Script to pass invitee ID into modal -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const placementModal = document.getElementById('placementModal');
            placementModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const inviteeId = button.getAttribute('data-invitee-id');
                const inputField = placementModal.querySelector('#modal_invitee_id');
                if (inputField) {
                    inputField.value = inviteeId;
                }
            });
        });
    </script>



@endsection
