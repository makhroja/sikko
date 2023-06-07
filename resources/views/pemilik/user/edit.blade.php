@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">User</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Daftar User</h6>
                    <p class="card-description">Halaman untuk manajemen User</p>
                    <button type="button" class="btn btn-icon btn-outline-primary create mb-3">
                        <i data-feather="plus-square"></i>
                    </button>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h4 class="modal-title" id="modelHeading">Edit User</h4>
                        </div>
                        <form id="modalForm" name="modalForm" class="form-horizontal" method="POST"
                            action="{{ route('user.update', $query->id) }}">
                            <div class="card-body">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama">Nama:</label>
                                            <input type="text" name="nama" value="{{ $query->nama }}"
                                                class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="tgl_lahir">Tanggal Lahir:</label>
                                            <input type="date" name="tgl_lahir" value="{{ $query->tgl_lahir }}"
                                                class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="alamat">Alamat:</label>
                                            <input type="text" name="alamat" value="{{ $query->alamat }}"
                                                class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="jk">Jenis Kelamin:</label>
                                            <select name="jk" class="form-control" required>
                                                <option value="Laki-laki"
                                                    {{ $query->jk == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="Perempuan" {{ $query->jk == 'Perempuan' ? 'selected' : '' }}>
                                                    Perempuan</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="no_hp">Nomor HP:</label>
                                            <input type="text" name="no_hp" value="{{ $query->no_hp }}"
                                                class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="role">Role:</label>
                                            <select name="role" class="form-control" required>
                                                <option value="Penghuni"
                                                    {{ $query->role === 'Penghuni' ? 'selected' : '' }}>Penghuni</option>
                                                <option value="Pemilik" {{ $query->role === 'Pemilik' ? 'selected' : '' }}>
                                                    Pemilik</option>
                                                <option value="Admin" {{ $query->role === 'Admin' ? 'selected' : '' }}>
                                                    Admin</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" name="email" value="{{ $query->email }}"
                                                class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password:</label>
                                            <input type="password" name="password" class="form-control" >
                                        </div>

                                        <div class="form-group">
                                            <label for="password_confirmation">Konfirmasi Password:</label>
                                            <input type="password" name="password_confirmation" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="is_active">Status Aktif:</label>
                                            <select class="form-control" id="is_active" name="is_active" required>
                                                <option value="1" {{ $query->is_active == 1 ? 'selected' : '' }}>Aktif</option>
                                                <option value="0" {{ $query->is_active == 0 ? 'selected' : '' }}>Tidak</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Update</button>
                                <a href="{{ route('user.index') }}" class="btn btn-danger float-right"
                                    data-dismiss="modal">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('plugin-scripts')
@endpush
@push('custom-scripts')
    @include('pemilik.user.js')
@endpush
