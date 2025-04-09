@extends('layouts.guest')

@section('content')
<div class="row w-100 m-0 justify-content-center">
    <!-- Gambar Ilustrasi -->
    <div class="col-lg-6 d-none d-lg-block">
        <div class="auth-cover-wrapper bg-light rounded-4 shadow-sm">
            <div class="auth-cover text-center p-5">
                <h1 class="text-primary fw-bold mb-4">{{ __('Verify Your Email') }}</h1>
                <img src="{{ asset('images/auth/signin-image.svg') }}" class="img-fluid" alt="Verify Email Image">
            </div>
        </div>
    </div>

    <!-- Konten Verifikasi -->
    <div class="col-lg-6">
        <div class="signin-wrapper">
            <div class="form-wrapper bg-white p-5 rounded-4 shadow-sm">
                <h3 class="text-center text-dark fw-bold mb-4">{{ __('Email Verification Required') }}</h3>
                
                <p class="text-sm text-muted text-center mb-4">
                    {{ __('Before continuing, please check your email for a verification link.') }}
                </p>

                @if (session('resent'))
                    <div class="alert alert-success text-center" role="alert">
                        {{ __('A new verification link has been sent to your email.') }}
                    </div>
                @endif

                <p class="text-sm text-muted text-center mb-4">
                    {{ __('Didn\'t receive the email? Click below to resend.') }}
                </p>

                <form action="{{ route('verification.resend') }}" method="POST">
                    @csrf
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            {{ __('Resend Verification Email') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
