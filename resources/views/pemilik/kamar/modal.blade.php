<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card-header">
                <h4 class="modal-title" id="modelHeading">Tambah Kamar</h4>
            </div>
            <form id="modalForm" name="modalForm" class="form-horizontal" method="POST"
                action="{{ route('kamar.store') }}">
                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" name="kamar_id" id="kamar_id">
                            <div class="form-group">
                                <label for="nama_kost" class="col-sm-4 control-label">Nama Kost</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="nama_kost" name="nama_kost"
                                        value="" maxlength="50" required="">
                                    @error('nama_kost')
                                        <span class="invalid-feedback" role="alert"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="no_kamar" class="col-sm-4 control-label">No Kamar</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" id="no_kamar" name="no_kamar"
                                        value="" required="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="lokasi" class="col-sm-4 control-label">Lokasi</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="lokasi" name="lokasi"
                                        value="" required="">
                                    @error('lokasi')
                                        <span class="invalid-feedback" role="alert"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">


                            <div class="form-group">
                                <label for="harga" class="col-sm-4 control-label">Harga</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="harga" name="harga"
                                        value="" required="">
                                    @error('harga')
                                        <span class="invalid-feedback" role="alert"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="fasilitas" class="col-sm-4 control-label">Fasilitas</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="fasilitas" name="fasilitas"
                                        value="" required="">
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
                                        <option value="1">Isi</option>
                                        <option value="0">Kosong</option>
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
                    <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save</button>
                    <button class="btn btn-danger float-right" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
