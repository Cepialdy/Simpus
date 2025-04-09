@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-muted fw-semibold">{{ __('Pasien Rawat Inap') }}</h2>
        </div>

        <div class="card shadow-sm border-0 rounded-lg p-4" style="background: #f9fafb;">
            <form action="{{ route('inpatients.index') }}" method="GET" class="mb-3">
                <div class="row g-2">
                    <div class="col-md-3">
                        <input type="date" name="start_date" class="form-control rounded-lg border-light" value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="end_date" class="form-control rounded-lg border-light" value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary rounded-pill px-4"><i class="fas fa-search"></i> {{ __('Search') }}</button>
                        <a href="{{ route('inpatients.index') }}" class="btn btn-outline-secondary rounded-pill px-4">{{ __('Reset') }}</a>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover rounded-lg" style="border-collapse: separate; border-spacing: 0 8px;">
                    <thead class="table-light text-muted text-center">
                        <tr>
                            <th class="py-3">Nama Pasien</th>
                            <th>Nama Kamar</th>
                            <th>Waktu Masuk</th>
                            <th>Waktu Keluar</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inpatients as $data)
                            <tr class="align-middle" style="background: #ffffff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);">
                                <td class="py-3 px-4 text-muted">{{ $data->patient->full_name }}</td>
                                <td>{{ $data->room->name }}</td>
                                <td>{{ date('d-M-Y H:i', strtotime($data->admitted_at)) }}</td>
                                <td>{{ $data->discharged_at ?? 'Belum Keluar' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('patients.show', $data->patient->id) }}" class="btn btn-sm btn-outline-primary rounded-pill">Show</a>
                                    <a href="{{ route('inpatients.printBracelet', $data->id) }}" class="btn btn-sm btn-success rounded-pill">Cetak Gelang</a>
                                    <button type="button" class="btn btn-sm btn-warning rounded-pill text-white" data-bs-toggle="modal" data-bs-target="#editQueueModal-{{ $data->id }}">Edit</button>
                                    <form action="{{ route('inpatients.destroy', $data->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger rounded-pill">Delete</button>
                                    </form>
                                </td>
                            </tr>

                            {{-- Modal Edit --}}
                            <div class="modal fade" id="editQueueModal-{{ $data->id }}" tabindex="-1" aria-labelledby="editQueueModalLabel-{{ $data->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light">
                                            <h5 class="modal-title text-muted">Edit Rawat Inap</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('inpatients.update', $data->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label class="form-label text-muted">Pilih Pasien</label>
                                                    <select class="form-control rounded-lg border-light" name="patient_id">
                                                        @foreach ($patients as $patient)
                                                            <option value="{{ $patient->id }}" {{ $patient->id == $data->patient_id ? 'selected' : '' }}>{{ $patient->full_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label text-muted">Pilih Dokter</label>
                                                    <select class="form-control rounded-lg border-light" name="doctor_id">
                                                        @foreach ($doctors as $doctor)
                                                            <option value="{{ $doctor->id }}" {{ $doctor->id == $data->doctor_id ? 'selected' : '' }}>{{ $doctor->full_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label text-muted">Pilih Kamar</label>
                                                    <select name="room_number" class="form-control rounded-lg border-light">
                                                        @foreach ($rooms as $room)
                                                            <option value="{{ $room->name }}" {{ $room->name == $data->room_number ? 'selected' : '' }}>{{ $room->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label text-muted">Waktu Masuk</label>
                                                    <input type="datetime-local" class="form-control rounded-lg border-light" name="admitted_at" value="{{ \Carbon\Carbon::parse($data->admitted_at)->format('Y-m-d\TH:i') }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label text-muted">Waktu Keluar</label>
                                                    <input type="datetime-local" class="form-control rounded-lg border-light" name="discharged_at">
                                                </div>
                                                <button type="submit" class="btn btn-primary w-100 rounded-pill">Simpan Perubahan</button>
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
@endsection
