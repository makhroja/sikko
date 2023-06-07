@extends('layout.master')
@push('plugin-styles')

@endpush
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kamar</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Daftar Kamar</h6>
                    <p class="card-description">Halaman untuk manajemen Kamar</p>
                    <button type="button" class="btn btn-icon btn-outline-primary create mb-3">
                        <i data-feather="plus-square"></i>
                    </button>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h4 class="modal-title" id="modelHeading">Edit Kamar</h4>
                        </div>
                        <form id="modalForm" name="modalForm" class="form-horizontal" method="POST"
                            action="{{ route('kamar.update',$query->id)}}">
                            <div class="card-body">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_kost" class="col-sm-4 control-label">Nama Kost</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="nama_kost" name="nama_kost"
                                                    value="{{ $query->nama_kost }}" maxlength="50" required="">
                                                @error('nama_kost')
                                                    <span class="invalid-feedback" role="alert"> {{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="no_kamar" class="col-sm-4 control-label">No Kamar</label>
                                            <div class="col-sm-12">
                                                <input type="number" class="form-control" id="no_kamar" name="no_kamar"
                                                    value="{{ $query->no_kamar }}" required="">
                                                @error('no_kamar')
                                                    <span class="invalid-feedback" role="alert"> {{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="lokasi" class="col-sm-4 control-label">Lokasi</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="lokasi" name="lokasi"
                                                    value="{{ $query->lokasi }}" required="">
                                            </div>
                                            @error('lokasi')
                                                <span class="invalid-feedback" role="alert"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">


                                        <div class="form-group">
                                            <label for="harga" class="col-sm-4 control-label">Harga</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="harga" name="harga"
                                                    value="{{ $query->harga }}" required="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="fasilitas" class="col-sm-4 control-label">Fasilitas</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="fasilitas" name="fasilitas"
                                                    value="{{ $query->fasilitas }}" required="">
                                                @error('fasilitas')
                                                    <span class="invalid-feedback" role="alert"> {{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label for="status" class="col-sm-4 control-label">Status</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" id="status" name="status" required="">
                                                    <option value="" disabled selected>Select Status</option>
                                                    <option value="1"
                                                        @if ($query->status == 1) selected @endif>Isi</option>
                                                    <option value="0"
                                                        @if ($query->status == 0) selected @endif>Kosong</option>
                                                </select>
                                                @error('status')
                                                    <span class="invalid-feedback" role="alert"> {{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" id="saveBtn"
                                    value="create">Update</button>
                                <a href="{{ route('kamar.index') }}" class="btn btn-danger float-right" data-dismiss="modal">Batal</a>
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
