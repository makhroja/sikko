@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">keluhan</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Daftar Tagihan</h6>
                    <p class="card-description">Halaman untuk manajemen Tagihan</p>
                    <button type="button" class="btn btn-icon btn-outline-primary create mb-3">
                        <i data-feather="plus-square"></i>
                    </button>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h4 class="modal-title" id="modelHeading">Edit Tagihan</h4>
                        </div>
                        <form id="modalForm" name="modalForm" class="form-horizontal" method="POST"
                            action="{{ route('tagihan.update', $query->id) }}">
                            <div class="card-body">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label for="user_id" class="">No Tagihan</label>
                                    <input type="text" name="no_tagihan" class="form-control col-md-2" value="{{$query->no_tagihan}}" readonly>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="user_id">Penghuni</label>
                                            <select name="user_id" id="user_id" class="form-control" required>
                                                <option value="">Pilih Penghuni</option>
                                                @foreach ($user as $u)
                                                    <option value="{{ $u->id }}" {{ $query->user_id == $u->id ? 'selected' : '' }}>
                                                        {{ $u->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="tgl_tagihan">Tanggal Tagihan:</label>
                                            <input type="date" name="tgl_tagihan" class="form-control" required value="{{ $query->tgl_tagihan }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="bulan">Bulan:</label>
                                            <select name="bulan" class="form-control" required>
                                                {!! bulanOptions($query->bulan) !!}
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="total_tagihan">Total Tagihan:</label>
                                            <input type="number" name="total_tagihan" class="form-control" required value="{{ $query->total_tagihan }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status" required>
                                                <option value="0" {{ $query->status == 0 ? 'selected' : '' }}>Belum Lunas</option>
                                                <option value="1" {{ $query->status == 1 ? 'selected' : '' }}>Lunas</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="tahun">Tahun:</label>
                                            <select name="tahun" class="form-control" required>
                                                {!! tahunOptions($query->tahun) !!}
                                            </select>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Update</button>
                                <a href="{{ route('tagihan.index') }}" class="btn btn-danger float-right"
                                    data-dismiss="modal">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pemilik.tagihan.modal')
@endsection
@push('plugin-scripts')
@endpush
@push('custom-scripts')
    @include('pemilik.tagihan.js')
@endpush
