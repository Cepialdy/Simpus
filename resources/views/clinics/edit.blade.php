@extends('layouts.app')

@section('content')
    <div class="title-wrapper pt-4 pb-3">
        <div class="row align-items-center">
            <div class="col-md-12">
                <h2 class="fw-bold text-white bg-primary p-3 rounded text-center">{{ __('Edit Klinik') }}</h2>
            </div>
        </div>
    </div>
    
    <div class="card shadow-lg rounded-3 border-0">
        <div class="card-body p-4">
            <form action="{{ route('clinics.update', $clinic) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold text-secondary">{{ __('Nama Klinik') }}</label>
                    <input type="text" class="form-control border rounded-2 shadow-sm" id="name" name="name" value="{{ old('name', $clinic->name) }}" placeholder="Masukkan Nama Klinik">
                    @error('name')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tarif" class="form-label fw-semibold text-secondary">{{ __('Tarif') }}</label>
                    <input type="text" class="form-control border rounded-2 shadow-sm" id="tarif" name="tarif" value="{{ old('tarif', $clinic->tarif) }}" placeholder="Masukkan Tarif">
                    @error('tarif')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary w-100 fw-semibold shadow-sm">{{ __('Simpan') }}</button>
            </form>
        </div>
    </div>
@endsection
