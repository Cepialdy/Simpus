@extends('layouts.guest')

@section('content')
<div class="row w-100 m-0">
    <!-- Bagian Gambar (Kiri) -->
    <div class="col-lg-6 p-0">
        <div class="auth-cover-wrapper bg-light d-flex align-items-center justify-content-center">
            <div class="auth-cover text-center">
                <h1 class="text-primary mb-4">{{ __('Login') }}</h1>
                <div class="cover-image">
                    <img src="{{ asset('images/auth/signin-image.svg') }}" alt="Login Illustration" class="img-fluid">
                </div>
                <div class="shape-image position-absolute opacity-50">
                    <img src="{{ asset('images/auth/shape.svg') }}" alt="Decorative Shape">
                </div>
            </div>
        </div>
    </div>

    <!-- Bagian Form Login (Kanan) -->
    <div class="col-lg-6 p-0 d-flex align-items-center justify-content-center">
        <div class="signin-wrapper w-75">
            <div class="form-wrapper p-4 shadow rounded bg-white">
                <h6 class="mb-3 text-center text-secondary">{{ __('Login') }}</h6>
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Enter your email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Enter your password') }}" required autocomplete="current-password">
                        @error('password')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-decoration-none text-primary">
                                {{ __('Forgot Password?') }}
                            </a>
                        @endif
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            {{ __('Login') }}
                        </button>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('register') }}" class="text-decoration-none text-secondary">
                            {{ __('Create an account?') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
