@extends('layouts.app')

@section('content')
    <div class="title-wrapper pt-4 pb-3">
        <div class="row align-items-center">
            <div class="col-md-12">
                <h2 class="fw-bold text-white bg-primary p-3 rounded text-center">{{ __('Klinik') }}</h2>
            </div>
        </div>
    </div>
    
    <div class="card shadow-lg rounded-3 border-0">
        <div class="card-body p-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="mb-3 text-end">
                <a href="{{ route('clinics.create') }}" class="btn btn-primary fw-semibold shadow-sm">+ Clinics</a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Tarif</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clinics as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->name }}</td>
                                <td>Rp. {{ number_format($data->tarif, 0, ',', '.') ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('clinics.edit', $data) }}" class="btn btn-secondary btn-sm">Edit</a>
                                    <form action="{{ route('clinics.destroy', $data) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $clinics->links() }}
            </div>
        </div>
    </div>
@endsection
