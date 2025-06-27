@extends('frontend.master')

@section('title', 'Reset Password')

@section('content')
<div class="login-section padding-tb section-bg">
    <div class="container">
        <div class="account-wrapper">
            <h3 class="title">Reset Password</h3>

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('password.updateNew') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                <div class="form-group">
                    <input type="password" name="password" placeholder="New Password" required>
                </div>

                <div class="form-group">
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="d-block lab-btn"><span>Reset Password</span></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
