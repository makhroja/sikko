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
                    <h6 class="card-title">Daftar Pengeluaran</h6>
                    <p class="card-description">Halaman untuk manajemen Pengeluaran</p>
                    <button type="button" class="btn btn-icon btn-outline-primary create mb-3">
                        <i data-feather="plus-square"></i>
                    </button>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h4 class="modal-title" id="modelHeading">Edit Pengeluaran</h4>
                        </div>
                        <form id="modalForm" name="modalForm" class="form-horizontal" method="POST"
                            action="{{ route('pengeluaran.update', $query->id) }}" enctype="multipart/form-data">
                            <div class="card-body">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tgl_pengeluaran">Tanggal Pengeluaran:</label>
                                            <input class="form-control" type="date" name="tgl_pengeluaran"
                                                id="tgl_pengeluaran" value="{{ $query->tgl_pengeluaran }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="total">Total:</label>
                                            <input class="form-control" type="number" name="total" id="total"
                                                value="{{ $query->total }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="keperluan">Keperluan:</label>
                                            <textarea  class="form-control" name="keperluan" id="keperluan" rows="4" required>{{ $query->keperluan }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="bukti_pengeluaran">Bukti Pengeluaran:</label>
                                            <input class="form-control" type="file" name="bukti_pengeluaran"
                                                id="bukti_pengeluaran">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="bukti_pengeluaran">Bukti Pengeluaran Tersimpan:</label>
                                            <div class="form-group">
                                                  <a class="btn btn-primary btn-sm show-bukti"
                                            onclick="showBukti('{{ url('images/bukti_pengeluaran/') }}/{{ $query->bukti_pengeluaran }}');"
                                            data-bukti-image="">Lihat
                                            Bukti</a>
                                            </div>
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
                    <h5 class="modal-title" id="buktiModalLabel">Bukti Pengeluaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="buktiImage" src="" alt="Bukti Pengeluaran" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    @include('pemilik.pengeluaran.modal')
@endsection
@push('plugin-scripts')
@endpush
@push('custom-scripts')
    @include('pemilik.pengeluaran.js')
@endpush
