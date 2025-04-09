@extends('layouts.app')

@section('content')
<div class="container-fluid py-5">
    <div class="card shadow-lg border-0 rounded-4 p-4">
        <div class="card-body">
            <h2 class="fw-bold text-center text-primary mb-4">
                <i class="fas fa-procedures me-2"></i>{{ __('Pasien Rawat Jalan') }}
            </h2>
            
            <div class="alert-box primary-alert">
                @if (session('success'))
                    <div class="alert alert-success">
                        <h4 class="alert-heading">Success</h4>
                        <p class="text-medium">{{ session('success') }}</p>
                    </div>
                @endif
            </div>
            
            <form action="{{ route('outpatients.index') }}" method="GET" class="mb-4">
                <div class="row g-2">
                    <div class="col-md-3">
                        <input type="date" name="start_date" class="form-control" placeholder="Start Date" value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="end_date" class="form-control" placeholder="End Date" value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search"></i> {{ __('Search') }}
                        </button>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('outpatients.index') }}" class="btn btn-secondary w-100">
                            <i class="fas fa-sync-alt"></i> {{ __('Reset') }}
                        </a>
                    </div>
                </div>
            </form>
            
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>No Rekam Medis</th>
                            <th>Poliklinik</th>
                            <th>Tanggal Masuk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($outpatients as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->patient->full_name }}</td>
                                <td>{{ $data->patient->medical_record_number }}</td>
                                <td>{{ $data->clinic->name }}</td>
                                <td>{{ date('d M Y', strtotime($data->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center">
                {{ $outpatients->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
