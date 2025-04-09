@extends('layouts.app')

@section('content')
    <div class="title-wrapper pt-4 pb-3">
        <div class="row align-items-center">
            <div class="col-md-12">
                <h2 class="fw-bold text-white bg-primary p-3 rounded text-center">{{ __('Daftar Dokter') }}</h2>
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
            
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('doctors.create') }}" class="btn btn-primary fw-semibold shadow-sm">+ Tambah Dokter</a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-primary text-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Spesialis</th>
                            <th>Jenis Kelamin</th>
                            <th>Tarif</th>
                            <th>No Telepon</th>
                            <th>Email</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($doctors as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->full_name }}</td>
                                <td>{{ $data->specialization }}</td>
                                <td>{{ $data->gender }}</td>
                                <td>Rp. {{ number_format($data->tarif, 0, ',', '.') }}</td>
                                <td>{{ $data->phone }}</td>
                                <td>{{ $data->email }}</td>
                                <td class="text-center">
                                    <a href="{{ route('doctors.edit', $data) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('doctors.destroy', $data) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $doctors->links() }}
            </div>
        </div>
    </div>
@endsection
