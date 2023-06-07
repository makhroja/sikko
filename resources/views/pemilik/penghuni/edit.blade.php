@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Penghuni</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Daftar Penghuni</h6>
                    <p class="card-description">Halaman untuk manajemen Penghuni</p>
                    <button type="button" class="btn btn-icon btn-outline-primary create mb-3">
                        <i data-feather="plus-square"></i>
                    </button>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h4 class="modal-title" id="modelHeading">Edit Penghuni</h4>
                        </div>
                        <form id="modalForm" name="modalForm" class="form-horizontal" method="POST"
                            action="{{ route('penghuni.update', $query->id) }}">
                            <div class="card-body">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="user_id">User ID</label>
                                            <select type="text" class="form-control" name="user_id" id="user_id">
                                                <option value="">Pilih User</option>
                                                @foreach ($user as $u)
                                                    <option value="{{ $u->id }}"
                                                        {{ $query->user_id == $u->id ? 'selected' : '' }}>
                                                        {{ $u->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="kamar_id">Kamar ID</label>
                                            <select type="text" class="form-control" name="kamar_id" id="kamar_id">
                                                <option value="" disabled selected>Select Kamar</option>
                                                @foreach ($kamar as $k)
                                                    <option value="{{ $k->id }}"
                                                        {{ $query->kamar_id == $k->id ? 'selected' : '' }}>
                                                        {{ $k->nama_kost }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="tgl_masuk">Tanggal Masuk</label>
                                            <input type="date" class="form-control" name="tgl_masuk" id="tgl_masuk"
                                                value="{{ $query->tgl_masuk }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="tgl_keluar">Tanggal Keluar</label>
                                            <input type="date" class="form-control" name="tgl_keluar" id="tgl_keluar"
                                                value="{{ $query->tgl_keluar }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="status" class="col-sm-4 control-label">Status</label>
                                            <select class="form-control" id="status" name="status" required="">
                                                <option value="1" {{ $query->status == 1 ? 'selected' : '' }}>Aktif
                                                </option>
                                                <option value="0" {{ $query->status == 0 ? 'selected' : '' }}>Tidak
                                                    Aktif</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="tipe">Tipe Penghuni</label>
                                            <select class="form-control" id="tipe" name="tipe" required="">
                                                <option value="" disabled selected>Select Tipe</option>
                                                <option value="Bulanan"
                                                    {{ $query->tipe === 'Bulanan' ? 'selected' : '' }}>Bulanan
                                                </option>
                                                <option value="Tahunan"
                                                    {{ $query->tipe === 'Tahunan' ? 'selected' : '' }}>Tahunan
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" id="saveBtn"
                                    value="create">Update</button>
                                <a href="{{ route('penghuni.index') }}" class="btn btn-danger float-right"
                                    data-dismiss="modal">Batal</a>
                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
    @include('pemilik.kamar.modal')
@endsection
@push('plugin-scripts')
@endpush
@push('custom-scripts')
    @include('pemilik.kamar.js')
@endpush
