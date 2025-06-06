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

    <div class="container-fluid mb-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Invitation Code</h5>
                        <p class="card-text fs-5 fw-bold">{{ $customer->invite_code ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Left Side Points</h5>
                        <p class="card-text fs-5 fw-bold">{{ $customer->left_side_points ?? 0 }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <h5 class="card-title">Right Side Points</h5>
                        <p class="card-text fs-5 fw-bold">{{ $customer->right_side_points ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (
        $customer &&
            $customer->is_first_time_withdrawal == 0 &&
            $customer->left_side_points >= 1 &&
            $customer->right_side_points >= 1)
        <div class="container-fluid mb-4">
            <div class="alert alert-success text-center" role="alert">
                Congratulations! You are eligible for your first withdrawal. Please contact support to proceed.
            </div>

            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Ready to Withdraw?</h5>
                    <p class="card-text">You meet the requirements for your first withdrawal. Click below to continue.</p>
                    <a href="{{ route('student.withdraw') }}" class="btn btn-success">Proceed to Withdraw</a>
                </div>
            </div>
        </div>
    @elseif (
        $customer &&
            $customer->is_first_time_withdrawal == 1 &&
            $customer->left_side_points >= 2 &&
            $customer->right_side_points >= 2)
        <div class="container-fluid mb-4">
            <div class="alert alert-info text-center" role="alert">
                Congratulations! You are eligible for your withdrawal. Please contact support to proceed.
            </div>

            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Withdraw Available</h5>
                    <p class="card-text">You have enough points for your next withdrawal. Click below to continue.</p>
                    <a href="{{ route('student.withdraw') }}" class="btn btn-primary">Proceed to Withdraw</a>
                </div>
            </div>
        </div>
    @elseif ($customer && $customer->is_first_time_withdrawal == 0 && ($customer->left_side_points < 1 || $customer->right_side_points < 1))
        <div class="container-fluid mb-4">
            <div class="alert alert-warning text-center" role="alert">
                You need at least 1 point on both sides to make your first withdrawal.
            </div>
        </div>
    @else
        <div class="container-fluid mb-4">
            <div class="alert alert-danger text-center" role="alert">
                You are not eligible for a withdrawal at this time. Please ensure you have at least 2 point on both sides.
            </div>
        </div>
    @endif



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
    <div class="modal fade" id="placementModal" tabindex="-1" aria-labelledby="placementModalLabel" aria-hidden="true">
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
