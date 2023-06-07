@extends('layout.master')
@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Keuangan</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Laporan Keuangan</h6>
                    <p class="card-description">Halaman Laporan Keuangan</p>
                    <form id="filter-form">
                        <div class="form-group row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bulan">Bulan:</label>
                                    <select name="bulan" id="bulan">
                                        <option value="">Pilih Bulan</option>
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tahun">Tahun:</label>
                                    <select name="tahun" id="tahun">
                                        {!! tahunOptions() !!}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <button class="btn btn-primary" type="submit">Filter</button>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <h5 class="col-md-6 text-success">PEMASUKAN : {{ number_format($totalPemasukan) }}</h5>
                                    <h5 class="col-md-6 text-danger">PENGELUARAN : {{ number_format($totalPengeluaran) }}
                                    </h5>
                                </div>
                            </div>
                        </div>

                    </form>

                    <div class="row mt-3">
                        <div class="col-lg-12 col-xl-12 stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                                        <h6 class="card-title mb-0">Pemasukan</h6>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="pt-0">#</th>
                                                    <th class="pt-0">Nama</th>
                                                    <th class="pt-0">Nomor</th>
                                                    <th class="pt-0">Bulan-Tahun</th>
                                                    <th class="pt-0">Total</th>
                                                    <th class="pt-0">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($pemasukan->isEmpty())
                                                    <tr>
                                                        <td>
                                                            <p>Tidak ada data pemasukan pada bulan dan tahun tersebut.</p>
                                                        </td>
                                                    </tr>
                                                @else
                                                    <?php $i = 1; ?>
                                                    @foreach ($pemasukan as $item)
                                                        <tr>
                                                            <td>{{ $i++ }}</td>
                                                            <td>{{ $item->user->nama }}</td>
                                                            <td>{{ $item->no_faktur }}</td>
                                                            <td>{{ $item->tgl_bayar }}</td>
                                                            <td>{{ $item->total_bayar }}</td>
                                                            <td>
                                                                @if ($item->status == 1)
                                                                    <span class="badge badge-success"> Lunas </span>
                                                                @else
                                                                    <span class="badge badge-secondary"> Belum </span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ $pemasukan->links() }}
                        <div class="col-lg-12 col-xl-12 stretch-card mt-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                                        <h6 class="card-title mb-0">Pengeluaran</h6>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="pt-0">#</th>
                                                    <th class="pt-0">Tanggal</th>
                                                    <th class="pt-0">Keperluan</th>
                                                    <th class="pt-0">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($pengeluaran->isEmpty())
                                                    <tr>
                                                        <td>
                                                            <p>Tidak ada data pemasukan pada bulan dan tahun tersebut.</p>
                                                        </td>
                                                    </tr>
                                                @else
                                                    <?php $i = 1; ?>
                                                    @foreach ($pengeluaran as $item)
                                                        <tr>
                                                            <td>{{ $i++ }}</td>
                                                            <td>{{ $item->tgl_pengeluaran }}</td>
                                                            <td>{{ $item->keperluan }}</td>
                                                            <td>{{ $item->total }}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ $pengeluaran->links() }}
                    </div> <!-- row -->
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
    @include('pemilik.pengeluaran.js')
@endpush
