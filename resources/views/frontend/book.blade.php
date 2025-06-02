@extends('frontend.master')

@section('title', 'Book VIP Package - ' . $package->title)

@section('content')

<!-- Page Header -->
<div class="pageheader-section">
    <div class="container">
        <div class="pageheader-content text-center">
            <h2>Join VIP Package</h2>
        </div>
    </div>
</div>

<!-- Booking Section -->
<div class="login-section padding-tb section-bg">
    <div class="container">
        <div class="row g-4">

            <!-- Left: Package Summary -->
            <div class="col-lg-5">
                <div class="card shadow-sm border-0 h-100 text-center">
                    <img src="{{ asset('storage/' . $package->image) }}" class="card-img-top mx-auto d-block" style="height: 200px; width: auto;" alt="{{ $package->title }}">
                    <div class="card-body">
                        <h4 class="card-title">{{ $package->title }}</h4>
                        <p class="text-muted">{{ \Illuminate\Support\Str::limit($package->description, 120) }}</p>
                        <p><strong>Price:</strong> <span class="text-danger fs-5">Rs. {{ number_format($package->price, 2) }}</span></p>
                    </div>
                </div>
            </div>

            <!-- Right: Form -->
            <div class="col-lg-7">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h4 class="mb-3 text-center">Your Information</h4>
                        <form action="{{ route('vip-packages.booking.submit') }}" method="POST" enctype="multipart/form-data" id="vipBookingForm">
                            @csrf
                            <input type="hidden" name="package_id" value="{{ $package->id }}">

                            <!-- User Info -->
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label>Your Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ session('customer_name') }}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label>Your Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ session('customer_email') }}" readonly>
                                </div>
                                <div class="col-12">
                                    <label>Contact Number</label>
                                    <input type="text" name="contact_number" class="form-control" value="{{ session('contact_number') }}" required>
                                </div>
                            </div>

                            <!-- Expand Payment -->
                            <div class="text-center mt-4">
                                <button type="button" class="btn btn-primary px-4" id="togglePayment">Proceed to Payment</button>
                            </div>

                            <!-- Payment Section -->
                            <div id="paymentSection" class="mt-4 d-none border-top pt-4">
                                <h5 class="text-center mb-3">Payment Method</h5>

                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label>Payment Method</label>
                                        <select name="payment_method" id="paymentMethod" class="form-control" required>
                                            <option value="">Select Method</option>
                                            <option value="Card">Card Payment</option>
                                            <option value="Bank Transfer">Bank Transfer</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Bank Transfer -->
                                <div id="bankDetails" class="mt-4 d-none">
                                    <h6 class="text-primary text-center">Bank Transfer Info</h6>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label>Bank Name</label>
                                            <input type="text" name="bank_name" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Branch</label>
                                            <input type="text" name="bank_branch" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Transfer Date</label>
                                            <input type="date" name="transfer_date" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Upload Receipt</label>
                                            <input type="file" name="receipt_path" class="form-control" accept="image/*,.pdf">
                                        </div>
                                    </div>
                                </div>

                                <!-- Card Payment -->
                                <div id="cardSection" class="text-center mt-4 d-none">
                                    <a href="#" class="btn btn-outline-primary">Proceed to Card Payment</a>
                                </div>

                                <!-- Submit -->
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-success px-5">Confirm Booking</button>
                                </div>
                            </div>
                            <!-- End Payment Section -->

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const togglePayment = document.getElementById('togglePayment');
        const paymentSection = document.getElementById('paymentSection');
        const paymentMethod = document.getElementById('paymentMethod');
        const bankDetails = document.getElementById('bankDetails');
        const cardSection = document.getElementById('cardSection');

        togglePayment.addEventListener('click', function () {
            paymentSection.classList.remove('d-none');
            togglePayment.classList.add('d-none');
        });

        paymentMethod.addEventListener('change', function () {
            if (this.value === 'Bank Transfer') {
                bankDetails.classList.remove('d-none');
                cardSection.classList.add('d-none');
            } else if (this.value === 'Card') {
                cardSection.classList.remove('d-none');
                bankDetails.classList.add('d-none');
            } else {
                bankDetails.classList.add('d-none');
                cardSection.classList.add('d-none');
            }
        });
    });
</script>
@endsection
