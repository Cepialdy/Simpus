@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-0 rounded-4 p-4 bg-light">
        <div class="card-body">
            <h2 class="fw-semibold text-center text-dark mb-4">
                <i class="fas fa-list-alt me-2 text-primary"></i>{{ __('Daftar Antrian') }}
            </h2>

            <button type="button" class="btn btn-outline-primary mb-3" data-bs-toggle="modal" data-bs-target="#createQueueModal">
                <i class="fas fa-plus"></i> Tambah Antrian
            </button>

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                    <p class="mb-0">{{ session('error') }}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="mb-4">
                <h4 class="fw-semibold text-secondary">{{ __('Rawat Jalan') }}</h4>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light border-bottom">
                            <tr class="text-muted">
                                <th>Nama Pasien</th>
                                <th>Nomor Antrian</th>
                                <th>Tanggal</th>
                                <th>Poli</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($queuesRawatJalan as $queue)
                                <tr>
                                    <td>{{ $queue->patient->full_name }}</td>
                                    <td class="text-primary fw-bold">{{ $queue->queue_code }}</td>
                                    <td>{{ $queue->created_at }}</td>
                                    <td>{{ $queue->clinic->name }}</td>
                                    <td>
                                        <a href="{{ route('queue.print', $queue->id) }}" class="btn btn-outline-dark btn-sm">
                                            <i class="fas fa-print"></i> Cetak
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mb-4">
                <h4 class="fw-semibold text-secondary">{{ __('Rawat Inap') }}</h4>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light border-bottom">
                            <tr class="text-muted">
                                <th>Nama Pasien</th>
                                <th>Nomor Antrian</th>
                                <th>Tanggal</th>
                                <th>Kamar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($queuesRawatInap as $queue)
                                <tr>
                                    <td>{{ $queue->patient->full_name }}</td>
                                    <td class="text-primary fw-bold">{{ $queue->queue_code }}</td>
                                    <td>{{ $queue->created_at }}</td>
                                    <td>{{ $queue->room->name }}</td>
                                    <td>
                                        <a href="{{ route('queue.print', $queue->id) }}" class="btn btn-outline-dark btn-sm">
                                            <i class="fas fa-print"></i> Cetak
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="createQueueModal" tabindex="-1" aria-labelledby="createQueueModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="createQueueModalLabel">Buat Antrian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('queue.create') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="patient_id" class="form-label">Pilih Pasien</label>
                        <select class="form-select" name="patient_id">
                            @foreach ($patients as $patient)
                                <option value="{{ $patient->id }}">{{ $patient->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="clinic_id" class="form-label">Pilih Poli</label>
                        <select class="form-select" name="clinic_id">
                            @foreach ($clinics as $clinic)
                                <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="doctor_id" class="form-label">Pilih Dokter</label>
                        <select class="form-select" name="doctor_id">
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}">{{ $doctor->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Pilih Layanan</label>
                        <select class="form-select" name="status" id="status" onchange="toggleRoomSelection()">
                            <option value="rawat jalan">Rawat Jalan</option>
                            <option value="rawat inap">Rawat Inap</option>
                        </select>
                    </div>
                    <div class="mb-3" id="roomSelection" style="display: none;">
                        <label for="room_id" class="form-label">Pilih Kamar</label>
                        <select class="form-select" name="room_id">
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-save"></i> Buat Antrian</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function toggleRoomSelection() {
        var status = document.getElementById('status').value;
        var roomSelection = document.getElementById('roomSelection');
        roomSelection.style.display = (status === 'rawat inap') ? 'block' : 'none';
    }
</script>
@endpush