@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div>
    <h4 class="mb-3 mb-md-0">Dashboard Pemilik</h4>
  </div>
  <div class="d-flex align-items-center flex-wrap text-nowrap">
    <div class="input-group date datepicker dashboard-date mr-2 mb-2 mb-md-0 d-md-none d-xl-flex" id="dashboardDate">
      <span class="input-group-addon bg-transparent"><i data-feather="calendar" class=" text-primary"></i></span>
      <input type="text" class="form-control">
    </div>
  </div>
</div>

<div class="row">
    <div class="col-12 col-xl-12 stretch-card">
        <div class="row flex-grow">
            <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0 text-primary">Total Kamar</h6>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-12 col-xl-12">
                                <h3 class="mb-2">{{ $kamar->count() }}</h3>
                                <h5 class="text-success">
                                    <span>Terisi : {{ $kamar->where('status', 1)->count() }}</span>
                                </h5>
                                <h5 class="text-secondary">
                                    <span>Kosong : {{ $kamar->where('status', 0)->count() }}</span>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0 text-primary">Total Penghuni</h6>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-12 col-xl-12">
                                <h3 class="mb-2">{{ $penghuni->count() }}</h3>
                                <h5 class="text-success">
                                    <span>Aktif : {{ $penghuni->where('status', 1)->count() }}</span>
                                </h5>
                                <h5 class="text-secondary">
                                    <span>Tidak : {{ $penghuni->where('status', 0)->count() }}</span>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0 text-primary">Keluhan</h6>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-12 col-xl-12">
                                <h3 class="mb-2">{{ $keluhan->count() }}</h3>
                                <h5 class="text-success">
                                    <span>Selesai : {{ $keluhan->where('user_id', \Auth::user()->id)->where('status', 1)->count() }}</span>
                                </h5>
                                <h5 class="text-secondary">
                                    <span>Belum : {{ $keluhan->where('user_id', \Auth::user()->id)->where('status', 0)->count() }}</span>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0 text-primary">Tagihan</h6>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-12 col-xl-12">
                                <h3 class="mb-2">{{ $tagihan->count() }}</h3>
                                <h5 class="text-success">
                                    <span>Lunas : {{ $tagihan->where('status', 1)->count() }}</span>
                                </h5>
                                <h5 class="text-secondary">
                                    <span>Belum : {{ $tagihan->where('status', 0)->count() }}</span>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- row -->
<div class="row">
    <div class="col-lg-5 col-xl-4 grid-margin grid-margin-xl-0 stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                    <h6 class="card-title mb-0">User Terbaru</h6>
                </div>
                @foreach ($user as $item)
                    <div class="d-flex flex-column">
                        <a href="#" class="d-flex align-items-center border-bottom pb-3">
                            <div class="mr-3">
                                <img src="{{ url('https://via.placeholder.com/35x35') }}" class="rounded-circle wd-35"
                                    alt="user">
                            </div>
                            <div class="w-100">
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-body mb-2">{{ $item->nama }}</h6>
                                    <p class="text-muted tx-12">{{ $item->email }}</p>
                                </div>
                                <p class="text-muted tx-13">{{ $item->alamat }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-7 stretch-card">
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
                            <?php $i=1; ?>
                            @foreach ($tagihanList as $item)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$item->user->nama}}</td>
                                    <td>{{$item->no_tagihan}}</td>
                                    <td>{{$item->bulan}}-{{$item->tahun}}</td>
                                    <td>{{$item->total_tagihan}}</td>
                                    <td>
                                        @if ($item->status == 1)
                                            <span class="badge badge-success"> Lunas </span>
                                        @else
                                        <span class="badge badge-secondary"> Belum </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> <!-- row -->

@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/chartjs/Chart.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/progressbar-js/progressbar.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>
@endpush
