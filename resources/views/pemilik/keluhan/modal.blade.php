<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card-header">
                <h4 class="modal-title" id="modelHeading">Tambah Keluhan</h4>
            </div>
            <form id="modalForm" name="modalForm" class="form-horizontal" method="POST"
                action="{{ route('keluhan.store') }}">
                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_id">User ID</label>
                                <select name="user_id" id="user_id">
                                    <option value="">Pilih Penghuni</option>
                                    @foreach ($user as $u)
                                        <option value="{{ $u->id }}">{{ $u->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tgl_keluhan">Tanggal Keluhan</label>
                                <input type="date" class="form-control" id="tgl_keluhan" name="tgl_keluhan">
                            </div>
                            <div class="form-group">
                                <label for="keluhan">Keluhan</label>
                                <textarea type="text" class="form-control" id="keluhan" name="keluhan" placeholder="Keluhan" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tgl_tanggapan">Tanggal Tanggapan</label>
                                <input type="date" class="form-control" id="tgl_tanggapan" name="tgl_tanggapan">
                            </div>
                            <div class="form-group">
                                <label for="solusi">Solusi</label>
                                <textarea type="text" class="form-control" id="solusi" name="solusi" placeholder="Solusi" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="1">Selesai</option>
                                    <option value="0">Belum Selesai</option>
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
