@extends('layouts.app')

@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2 class="text-primary">{{ __('Users') }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-4 p-4 bg-light">
        <div class="card-body">
            <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#createQueueModal">
                <i class="fas fa-user-plus"></i> Tambah User
            </button>

            <form action="{{ route('users.index') }}" method="GET" class="mb-4">
                <div class="row g-2">
                    <div class="col-md-3">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama atau NO RM" value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="email" class="form-control" placeholder="Cari email" value="{{ request('email') }}">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-info">Cari</button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>
            
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $data)
                            <tr>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->role }}</td>
                                <td>{{ $data->email }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editQueueModal-{{ $data->id }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                </td>
                            </tr>
                            <div class="modal fade" id="editQueueModal-{{ $data->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-warning text-white">
                                            <h5 class="modal-title">Edit Data User</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('users.update', $data->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label class="form-label">Nama User</label>
                                                    <input type="text" class="form-control" name="name" value="{{ old('name', $data->name) }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Role</label>
                                                    <select name="role" class="form-select">
                                                        <option value="Admin">Admin</option>
                                                        <option value="Doctor">Doctor</option>
                                                        <option value="Petugas Administrasi">Petugas Administrasi</option>
                                                        <option value="Petugas Spesialis">Petugas Spesialis</option>
                                                        <option value="Farmasi">Farmasi</option>
                                                        <option value="Perawat">Perawat</option>
                                                        <option value="Manajemen">Manajemen</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Email</label>
                                                    <input type="text" class="form-control" name="email" value="{{ old('email', $data->email) }}">
                                                </div>
                                                <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>

    <div class="modal fade" id="createQueueModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Buat Data User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama User</label>
                            <input type="text" class="form-control" name="name" placeholder="Nama" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-select">
                                <option value="Admin">Admin</option>
                                <option value="Doctor">Doctor</option>
                                <option value="Petugas Administrasi">Petugas Administrasi</option>
                                <option value="Petugas Spesialis">Petugas Spesialis</option>
                                <option value="Farmasi">Farmasi</option>
                                <option value="Perawat">Perawat</option>
                                <option value="Manajemen">Manajemen</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Tambah User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
