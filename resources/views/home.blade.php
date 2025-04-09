@extends('layouts.app')

@section('content')
    <div class="title-wrapper py-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-4">
                    <h2 class="text-primary fw-bold">Dashboard</h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                    <nav aria-label="breadcrumb">
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        @foreach([['Total Poli', $clinics->count(), 'purple', 'lni lni-cart-full'], ['Total Room', $rooms, 'success', 'lni lni-dollar'], ['Total Doctor', $doctors, 'primary', 'lni lni-credit-cards'], ['Total Pasien', $patients, 'orange', 'lni lni-user']] as [$title, $count, $color, $icon])
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-4 shadow-lg rounded-3 p-4 bg-white d-flex flex-column align-items-center">
                    <div class="icon text-{{ $color }} bg-light rounded-circle p-3 mb-2 shadow-sm">
                        <i class="{{ $icon }} fa-2x"></i>
                    </div>
                    <div class="content text-center">
                        <h6 class="mb-2 text-muted">{{ $title }}</h6>
                        <h3 class="text-dark fw-bold">{{ $count }}</h3>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <div class="row">
        @foreach($clinics as $clinic)
            <div class="col-md-12 col-lg-6 mb-4">
                <div class="card shadow-lg border-0 rounded-4 p-4">
                    <div class="card-body">
                        <h5 class="card-title text-primary fw-bold mb-2">Data Antrian {{$clinic->name}}</h5>
                        <small class="text-muted">Berikut daftar nomor antrian pasien hari ini untuk klinik {{$clinic->name}}</small>
                    </div>
                    <div class="card-body">
                        @if(isset($queuesByClinic[$clinic->id]) && !$queuesByClinic[$clinic->id]->isEmpty())
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="text-center">
                                    <h2 class="mb-2 text-dark fw-bold">{{$currentQueueNumbers[$clinic->id]}}</h2>
                                    <span class="text-muted">Nomor Antrian Sekarang</span>
                                    <form action="{{ route('home.updateQueue') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="clinic_id" value="{{ $clinic->id }}">
                                        <button type="submit" class="btn btn-outline-primary mt-2 rounded-pill">Antrian Selanjutnya</button>
                                    </form>
                                </div>
                                <div id="usersChart-{{ $clinic->id }}" data-laki-laki="{{ $queuesByClinic[$clinic->id]->where('patient.gender', 'Male')->count() }}" data-perempuan="{{ $queuesByClinic[$clinic->id]->where('patient.gender', 'Female')->count() }}"></div>
                            </div>
                            <ul class="list-unstyled">
                                @foreach($queuesByClinic[$clinic->id] as $queue)
                                    <li class="d-flex align-items-center mb-3 p-3 rounded-3 bg-light shadow-sm">
                                        <div class="avatar rounded-circle overflow-hidden me-3">
                                            <img src="{{ asset('assets/img/profil-images-default/' . ($queue->patient->gender == 'Male' ? 'man.jpeg' : 'girl.jpeg')) }}" alt="Profile Image" class="w-100">
                                        </div>
                                        <div class="w-100 d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1 text-dark text-capitalize">{{ $queue->patient->full_name }}</h6>
                                                <small class="text-muted">{{ $queue->created_at->locale('id')->diffForHumans() }}</small>
                                            </div>
                                            <span class="badge bg-info text-white rounded-pill">{{ $queue->queue_number }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-center text-muted">Belum ada antrian</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
