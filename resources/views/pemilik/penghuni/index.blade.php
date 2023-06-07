@extends('layout.master')
@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
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
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>No./Kamar</th>
                                        <th>JK</th>
                                        <th>No. Hp</th>
                                        <th>Alamat</th>
                                        <th>Tgl. Masuk</th>
                                        <th>Tipe</th>
                                        <th>Tgl. Keluar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pemilik.penghuni.modal')
@endsection
@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush
@push('custom-scripts')
    <style>
        #dataTable td {
            white-space: normal !important;
            word-wrap: break-word;
        }
    </style>
    @include('pemilik.penghuni.js')
@endpush
