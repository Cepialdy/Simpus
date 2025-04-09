@extends('layouts.app')

@section('content')
<div class="container-fluid py-5">
    <div class="card shadow-lg border-0 rounded-4 p-4">
        <div class="card-body">
            <h2 class="fw-bold text-center text-primary mb-4">
                <i class="fas fa-users me-2"></i>{{ __('Daftar Pasien') }}
            </h2>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (!in_array(auth()->user()->role, ['Pasien']))
                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('patients.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> {{ __('Tambah Pasien') }}
                    </a>
                </div>
            @endif

            <form action="{{ route('patients.index') }}" method="GET" class="mb-4">
                <div class="row g-2">
                    <div class="col-md-3">
                        <input type="text" name="search" class="form-control" placeholder="Cari Nama / NO RM" value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <select name="gender" class="form-select">
                            <option value="">Jenis Kelamin</option>
                            <option value="Male" {{ request('gender') == 'Male' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Female" {{ request('gender') == 'Female' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-2">
                        <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-3 d-grid">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
                        <a href="{{ route('patients.index') }}" class="btn btn-secondary mt-1"><i class="fas fa-sync"></i> Reset</a>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>NO RM</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Tanggal Masuk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patients as $data)
                            <tr>
                                <td>{{ $data->medical_record_number }}</td>
                                <td>{{ $data->full_name }}</td>
                                <td>{{ $data->gender }}</td>
                                <td>{{ $data->birth_date }}</td>
                                <td>{{ $data->address }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d M Y, h:i A') }}</td>
                                <td>
                                    <a href="{{ route('patients.show', $data) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('patients.edit', $data) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('patients.destroy', $data) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pasien ini?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $patients->links() }}
            </div>
        </div>
    </div>
</div>
@endsection