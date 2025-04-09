@extends('layouts.guest')

@section('content')
<div class="row w-100 m-0 justify-content-center">
    <!-- Gambar Ilustrasi -->
    <div class="col-lg-6 d-none d-lg-block">
        <div class="auth-cover-wrapper bg-light rounded-4 shadow-sm">
            <div class="auth-cover text-center p-5">
                <h1 class="text-primary fw-bold mb-4">{{ __('Register') }}</h1>
                <img src="{{ asset('images/auth/signin-image.svg') }}" class="img-fluid" alt="Register Image">
            </div>
        </div>
    </div>

    <!-- Form Registrasi -->
    <div class="col-lg-6">
        <div class="signin-wrapper">
            <div class="form-wrapper bg-white p-5 rounded-4 shadow-sm">
                <h3 class="text-center text-dark fw-bold mb-4">{{ __('Create Account') }}</h3>
                
                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">{{ __('Full Name') }}</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               name="name" id="name" placeholder="{{ __('Enter your full name') }}" 
                               value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">{{ __('Email Address') }}</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" id="email" placeholder="{{ __('Enter your email') }}" 
                               value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">{{ __('Password') }}</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                               name="password" id="password" placeholder="{{ __('Enter a strong password') }}" required>
                        @error('password')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label fw-semibold">{{ __('Confirm Password') }}</label>
                        <input type="password" class="form-control" name="password_confirmation" 
                               id="password_confirmation" placeholder="{{ __('Re-enter your password') }}" required>
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-lg">
                            {{ __('Register') }}
                        </button>
                    </div>

                    <div class="text-center">
                        <p class="mb-0">{{ __('Already have an account?') }} 
                            <a href="{{ route('login') }}" class="text-primary fw-bold">{{ __('Login here') }}</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
