@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="card shadow-lg border-0 rounded-4 p-4 bg-white">
            <div class="card-body">
                <h2 class="fw-bold text-center text-primary mb-4">
                    <i class="fas fa-bed me-2"></i> {{ __('Daftar Kamar') }}
                </h2>
                
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createRoomModal">
                    <i class="fas fa-plus"></i> Tambah Kamar
                </button>
                
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="table-light text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Kamar</th>
                                <th>Jenis</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rooms as $data)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->jenis }}</td>
                                    <td class="text-end">{{ "Rp ". number_format($data->tarif, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#editRoomModal-{{ $data->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('rooms.destroy', $data->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <div class="modal fade" id="editRoomModal-{{ $data->id }}" tabindex="-1" aria-labelledby="editRoomModalLabel-{{ $data->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-light">
                                                <h5 class="modal-title" id="editRoomModalLabel-{{ $data->id }}">Edit Kamar</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('rooms.update', $data->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label fw-semibold text-secondary">Nama Kamar</label>
                                                        <input type="text" class="form-control border rounded-3 shadow-sm" id="name" name="name" value="{{ old('name', $data->name) }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="tarif" class="form-label fw-semibold text-secondary">Tarif</label>
                                                        <input type="text" class="form-control border rounded-3 shadow-sm" id="tarif" name="tarif" value="{{ old('tarif', $data->tarif) }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="jenis" class="form-label fw-semibold text-secondary">Jenis</label>
                                                        <input type="text" class="form-control border rounded-3 shadow-sm" id="jenis" name="jenis" value="{{ old('jenis', $data->jenis) }}">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary w-100 fw-semibold shadow-sm">Simpan Perubahan</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="createRoomModal" tabindex="-1" aria-labelledby="createRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="createRoomModalLabel">Buat Kamar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('rooms.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold text-secondary">Nama Kamar</label>
                            <input type="text" class="form-control border rounded-3 shadow-sm" id="name" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="tarif" class="form-label fw-semibold text-secondary">Tarif</label>
                            <input type="text" class="form-control border rounded-3 shadow-sm" id="tarif" name="tarif">
                        </div>
                        <div class="mb-3">
                            <label for="jenis" class="form-label fw-semibold text-secondary">Jenis</label>
                            <input type="text" class="form-control border rounded-3 shadow-sm" id="jenis" name="jenis">
                        </div>
                        <button type="submit" class="btn btn-primary w-100 fw-semibold shadow-sm">Tambah Kamar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection