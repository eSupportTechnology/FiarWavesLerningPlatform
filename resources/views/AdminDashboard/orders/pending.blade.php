@extends('AdminDashboard.master')

@section('title', 'Pending Orders')

@section('breadcrumb-title')
    <h3>Pending Orders</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Orders</li>
    <li class="breadcrumb-item active">Pending</li>
@endsection

@section('content')
<div class="container-fluid">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0">Course Bookings</h5>
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs mb-3" id="bookingTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending"
                        type="button" role="tab">Bank Transfer - Pending</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="card-tab" data-bs-toggle="tab" data-bs-target="#card"
                        type="button" role="tab">Card - Confirmed</button>
                </li>
            </ul>

            <div class="tab-content" id="bookingTabsContent">
                <!-- Tab 1: Bank Transfer - Pending -->
                <div class="tab-pane fade show active" id="pending" role="tabpanel">
                    @include('AdminDashboard.orders.partials.booking-table', ['bookings' => $pendingBookings])
                </div>

                <!-- Tab 2: Card - Confirmed -->
                <div class="tab-pane fade" id="card" role="tabpanel">
                    @include('AdminDashboard.orders.partials.booking-table', ['bookings' => $cardConfirmedBookings])
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
