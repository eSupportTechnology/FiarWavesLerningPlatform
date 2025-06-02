@extends('frontend.master')

@section('title', 'Book Course - ' . $course->name)

@section('content')

<!-- Page Header -->
<div class="pageheader-section">
    <div class="container">
        <div class="pageheader-content text-center">
            <h2>Secure Your Seat</h2>
        </div>
    </div>
</div>

<!-- Booking Section -->
<div class="login-section padding-tb section-bg">
    <div class="container">
        <div class="row g-4">

            <!-- 🟦 Course Summary Box -->
            <div class="col-lg-5">
                <div class="card shadow-sm border-0 h-100 text-center">
                    <img src="{{ asset($course->image) }}" class="card-img-top mx-auto d-block" style="height:200px; width: 200px;" alt="{{ $course->name }}">
                    <div class="card-body">
                        <h4 class="card-title">{{ $course->name }}</h4>
                        <p class="mb-1"><strong>Duration:</strong> {{ $course->duration }} Days</p>
                        <p class="mb-1"><strong>Total Price:</strong> <span class="text-danger fs-5">Rs. {{ number_format($course->total_price, 2) }}</span></p>
                        <p class="mb-1"><strong>First Payment:</strong> <span class="text-warning">Rs. {{ number_format($course->first_payment, 2) }}</span></p>
                    </div>
                </div>
            </div>

            <!-- 🟦 Booking Info + Payment Box -->
            <div class="col-lg-7">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h4 class="mb-3 text-center">Your Information</h4>
                        <form action="{{ route('course.booking.submit') }}" method="POST" enctype="multipart/form-data" id="bookingForm">
                            @csrf
                            <input type="hidden" name="course_id" value="{{ $course->course_id }}">

                            <!-- Customer Info -->
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label>Your Name</label>
                                    <input type="text" class="form-control" value="{{ session('customer_name') }}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label>Your Email</label>
                                    <input type="email" class="form-control" value="{{ session('customer_email') }}" readonly>
                                </div>
                                <div class="col-12">
                                    <label>Contact Number </label>
                                    <input type="text" name="contact_number" class="form-control" value="{{ session('contact_number') }}" required>
                                </div>
                                <div class="col-md-12">
                                    <label>Address</label>
                                    <input type="textarea" name="address" class="form-control" placeholder="Enter your address">
                                </div>
                            </div>

                            <!-- Expand Button -->
                            <div class="text-center mt-4">
                                <button type="button" class="btn btn-primary px-4" id="togglePayment">Make Payment</button>
                            </div>

                            <!-- Payment Section (Initially Hidden) -->
                            <div id="paymentSection" class="mt-4 d-none border-top pt-4">
                                <h5 class="mb-3 text-center">Choose Payment Method</h5>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label>Payment Type</label>
                                        <select name="payment_status" class="form-control">
                                            <option value="">Select Payment</option>
                                            <option value="half">First Payment - Rs. {{ number_format($course->first_payment, 2) }}</option>
                                            <option value="full">Full Payment - Rs. {{ number_format($course->total_price, 2) }}</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Payment Method <span class="text-danger">*</span></label>
                                        <select name="payment_method" id="paymentMethod" class="form-control" required>
                                            <option value="">Select Method</option>
                                            <option value="Card">Card Payment</option>
                                            <option value="Bank Transfer">Bank Transfer</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Bank Transfer Details -->
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

                                <!-- Submit Button -->
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-success px-5">Confirm Booking</button>
                                </div>
                            </div> <!-- paymentSection -->
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
        const toggleButton = document.getElementById('togglePayment');
        const paymentSection = document.getElementById('paymentSection');
        const paymentMethod = document.getElementById('paymentMethod');
        const bankDetails = document.getElementById('bankDetails');

        if (toggleButton && paymentSection) {
            toggleButton.addEventListener('click', function () {
                paymentSection.classList.remove('d-none');
                toggleButton.classList.add('d-none');
            });
        }

        if (paymentMethod) {
            paymentMethod.addEventListener('change', function () {
                const value = this.value;

                if (value === 'Bank Transfer') {
                    bankDetails.classList.remove('d-none');
                } else {
                    bankDetails.classList.add('d-none');
                }
            });
        }
    });
</script>

