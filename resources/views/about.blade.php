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
                <table class="table table-hover table-bordered rounded-4">
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
                                    <button type="button" class="btn btn-warning btn-sm rounded-3" data-bs-toggle="modal" data-bs-target="#editQueueModal-{{ $data->id }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
