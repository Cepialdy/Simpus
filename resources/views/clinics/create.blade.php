@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-0 rounded-4 p-4 bg-light">
        <div class="card-body">
            <h2 class="fw-bold text-center text-primary mb-4">
                <i class="fas fa-hospital me-2"></i> Tambah Klinik
            </h2>

            <form action="{{ route('clinics.store') }}" method="POST" class="p-3">
                @csrf
                <div class="mb-4">
                    <label for="name" class="form-label fw-semibold text-secondary">Nama Klinik</label>
                    <input type="text" class="form-control shadow-sm rounded-3" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan Nama Klinik">
                    @error('name')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="tarif" class="form-label fw-semibold text-secondary">Tarif</label>
                    <input type="text" class="form-control shadow-sm rounded-3" id="tarif" name="tarif" value="{{ old('tarif') }}" placeholder="Masukkan Tarif">
                    @error('tarif')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100 fw-semibold shadow-sm">
                    <i class="fas fa-save me-2"></i> Simpan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
