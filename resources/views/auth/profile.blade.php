@extends('layouts.app')

@section('content')
<!-- ========== Header Profil ========== -->
<div class="title-wrapper pt-4 pb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h2 class="fw-bold text-primary">{{ __('My Profile') }}</h2>
        </div>
    </div>
</div>

<!-- ========== Kartu Profil ========== -->
<div class="card shadow-lg rounded-4 border-0 p-4">
    <div class="card-body">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ __('Success!') }}</strong> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">{{ __('Name') }}</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       name="name" id="name" placeholder="{{ __('Enter your name') }}" 
                       value="{{ old('name', auth()->user()->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">{{ __('Email') }}</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                       name="email" id="email" placeholder="{{ __('Enter your email') }}" 
                       value="{{ old('email', auth()->user()->email) }}" required>
                @error('email')
                    <div class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">{{ __('New Password') }}</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                       name="password" id="password" placeholder="{{ __('Enter new password') }}">
                @error('password')
                    <div class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="form-label fw-semibold">{{ __('Confirm New Password') }}</label>
                <input type="password" class="form-control" 
                       name="password_confirmation" id="password_confirmation" 
                       placeholder="{{ __('Confirm new password') }}">
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">
                    {{ __('Save Changes') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
