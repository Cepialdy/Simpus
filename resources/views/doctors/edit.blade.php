@extends('layouts.app')

@section('content')
    <div class="title-wrapper pt-4 pb-3">
        <div class="row align-items-center">
            <div class="col-md-12">
                <h2 class="fw-bold text-white bg-primary p-3 rounded text-center">{{ __('Edit Dokter') }}</h2>
            </div>
        </div>
    </div>
    
    <div class="card shadow-lg rounded-3 border-0">
        <div class="card-body p-4">
            <form action="{{ route('doctors.update', $doctor) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="full_name" class="form-label fw-semibold text-secondary">{{ __('Nama Lengkap') }}</label>
                    <input type="text" class="form-control border rounded-2 shadow-sm" id="full_name" name="full_name" value="{{ old('full_name', $doctor->full_name) }}">
                    @error('full_name')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="specialization" class="form-label fw-semibold text-secondary">{{ __('Spesialis') }}</label>
                    <input type="text" class="form-control border rounded-2 shadow-sm" id="specialization" name="specialization" value="{{ old('specialization', $doctor->specialization) }}">
                    @error('specialization')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label fw-semibold text-secondary">{{ __('Jenis Kelamin') }}</label>
                    <select class="form-control border rounded-2 shadow-sm" id="gender" name="gender">
                        <option value="Male" {{ $doctor->gender == 'Male' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Female" {{ $doctor->gender == 'Female' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('gender')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tarif" class="form-label fw-semibold text-secondary">{{ __('Tarif') }}</label>
                    <input type="text" class="form-control border rounded-2 shadow-sm" id="tarif" name="tarif" value="{{ old('tarif', $doctor->tarif) }}">
                    @error('tarif')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label fw-semibold text-secondary">{{ __('Nomor Telepon') }}</label>
                    <input type="text" class="form-control border rounded-2 shadow-sm" id="phone" name="phone" value="{{ old('phone', $doctor->phone) }}">
                    @error('phone')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold text-secondary">{{ __('Email') }}</label>
                    <input type="email" class="form-control border rounded-2 shadow-sm" id="email" name="email" value="{{ old('email', $doctor->email) }}">
                    @error('email')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary w-100 fw-semibold shadow-sm">{{ __('Simpan') }}</button>
            </form>
        </div>
    </div>
@endsection