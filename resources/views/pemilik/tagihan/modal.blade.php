<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card-header">
                <h4 class="modal-title" id="modelHeading">Tambah Tagihan</h4>

            </div>
            <form id="modalForm" name="modalForm" class="form-horizontal" method="POST"
                action="{{ route('tagihan.store') }}">
                <div class="card-body">
                    @csrf
                    <div class="form-group">
                        <label for="user_id" class="">No Tagihan</label>
                        <input type="text" name="no_tagihan" class="form-control col-md-2" value="{{generateNoTagihan()}}" readonly>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_id">Penghuni</label>
                                <select name="user_id" id="user_id">
                                    <option value="">Pilih Penghuni</option>
                                    @foreach ($user as $u)
                                        <option value="{{ $u->id }}">{{ $u->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="tgl_tagihan">Tanggal Tagihan:</label>
                                <input type="date" name="tgl_tagihan" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="bulan">Bulan:</label>
                                <select name="bulan" class="form-control" required>
                                    {!! bulanOptions() !!}
                                </select>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="total_tagihan">Total Tagihan:</label>
                                <input type="number" name="total_tagihan" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="0">Belum Lunas</option>
                                    <option value="1">Lunas
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="tahun">Tahun:</label>
                                <select name="tahun" class="form-control" required>
                                    {!! tahunOptions() !!}
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save</button>
                    <button class="btn btn-danger float-right" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
