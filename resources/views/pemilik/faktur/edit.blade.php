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
                    <h6 class="card-title">Daftar Faktur</h6>
                    <p class="card-description">Halaman untuk manajemen Faktur</p>
                    <button type="button" class="btn btn-icon btn-outline-primary create mb-3">
                        <i data-feather="plus-square"></i>
                    </button>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h4 class="modal-title" id="modelHeading">Edit Faktur</h4>
                        </div>
                        <form id="modalForm" name="modalForm" class="form-horizontal" method="POST"
                            action="{{ route('faktur.update', $query->id) }}" enctype="multipart/form-data">
                            <div class="card-body">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label for="no_faktur">Nomor Faktur:</label>
                                    <input class="form-control col-md-3" type="text" id="no_faktur"
                                        value="{{ $query->no_faktur }}" name="no_faktur" required readonly>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tagihan_id">Tagihan</label>
                                            <select name="tagihan_id" id="tagihan_id">
                                                <option value="">Pilih Tagihan</option>
                                                @foreach ($tagihan as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id == $query->tagihan_id ? 'selected' : '' }}>
                                                        {{ $item->no_tagihan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="total_bayar">Total Bayar:</label>
                                            <input class="form-control" type="text" id="total_bayar" name="total_bayar"
                                                value="{{ $query->total_bayar }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tgl_bayar">Tanggal Bayar:</label>
                                            <input class="form-control" type="date" id="tgl_bayar" name="tgl_bayar"
                                                value="{{ $query->tgl_bayar }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group">
                                            <label for="metode_pembayaran">Metode Pembayaran:</label>
                                            <input class="form-control" type="text" id="metode_pembayaran"
                                                name="metode_pembayaran" value="{{ $query->metode_pembayaran }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="bukti_pembayaran">Bukti Pembayaran:</label>
                                            <input class="form-control" type="file" id="bukti_pembayaran"
                                                name="bukti_pembayaran" accept=".jpg, .jpeg, .png">
                                            <br>
                                            <a class="btn btn-primary btn-sm show-bukti"
                                                onclick="showBukti('{{ url('images/bukti_pembayaran/') }}/{{ $query->bukti_pembayaran }}');"
                                                data-bukti-image="">Lihat
                                                Bukti</a>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status">
                                                <option value="1" {{ $query->status == 1 ? 'selected' : '' }}>Selesai
                                                </option>
                                                <option value="0" {{ $query->status == 0 ? 'selected' : '' }}>Belum
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Update</button>
                                <a href="{{ route('faktur.index') }}" class="btn btn-danger float-right"
                                    data-dismiss="modal">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="buktiModal" tabindex="-1" role="dialog" aria-labelledby="buktiModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="buktiModalLabel">Bukti Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="buktiImage" src="" alt="Bukti Pembayaran" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    @include('pemilik.faktur.modal')
@endsection
@push('plugin-scripts')
@endpush
@push('custom-scripts')
    @include('pemilik.faktur.js')
@endpush
