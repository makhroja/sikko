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
                    <h6 class="card-title">Daftar Keluhan</h6>
                    <p class="card-description">Halaman untuk manajemen Keluhan</p>
                    <button type="button" class="btn btn-icon btn-outline-primary create mb-3">
                        <i data-feather="plus-square"></i>
                    </button>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h4 class="modal-title" id="modelHeading">Edit Keluhan</h4>
                        </div>
                        <form id="modalForm" name="modalForm" class="form-horizontal" method="POST"
                            action="{{ route('penghuni.keluhan_update', $query->id) }}">
                            <div class="card-body">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="keluhan">Keluhan</label>
                                            <textarea type="text" class="form-control" id="keluhan" name="keluhan" placeholder="Keluhan" rows="3">{{ $query->keluhan }}</textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Update</button>
                                <a href="{{ route('keluhan.index') }}" class="btn btn-danger float-right"
                                    data-dismiss="modal">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('penghuni.keluhan.modal')
@endsection
@push('plugin-scripts')
@endpush
@push('custom-scripts')
    @include('penghuni.keluhan.js')
@endpush
