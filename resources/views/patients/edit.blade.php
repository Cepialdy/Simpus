@extends('layouts.app')

@section('content')
<div class="container-fluid py-5">
    <div class="card shadow-lg border-0 rounded-4 p-4">
        <div class="card-body">
            <h2 class="fw-bold text-center text-primary mb-4">
                <i class="fas fa-user-edit me-2"></i>{{ __('Edit Pasien') }}
            </h2>
            
            <form action="{{ route('patients.update', $patient) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="full_name" class="form-label">{{ __('Nama Lengkap') }}</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name', $patient->full_name) }}">
                        @error('full_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="nik" class="form-label">{{ __('NIK') }}</label>
                        <input type="text" class="form-control" id="nik" name="nik" value="{{ old('nik', $patient->nik) }}">
                        @error('nik')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <label for="gender" class="form-label">{{ __('Jenis Kelamin') }}</label>
                        <select class="form-select" id="gender" name="gender">
                            <option value="Male" {{ $patient->gender == 'Male' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Female" {{ $patient->gender == 'Female' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('gender')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="birth_date" class="form-label">{{ __('Tanggal Lahir') }}</label>
                        <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{ old('birth_date', $patient->birth_date) }}">
                        @error('birth_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <label for="phone" class="form-label">{{ __('Nomor Telepon') }}</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $patient->phone) }}">
                        @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $patient->email) }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mt-3">
                    <label for="address" class="form-label">{{ __('Alamat') }}</label>
                    <textarea class="form-control" id="address" name="address">{{ old('address', $patient->address) }}</textarea>
                    @error('address')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-save"></i> {{ __('Simpan') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
