<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card-header">
                <h4 class="modal-title" id="modelHeading">Tambah Pengeluaran</h4>
            </div>
            <form id="modalForm" name="modalForm" class="form-horizontal" method="POST"
                action="{{ route('pengeluaran.store') }}" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tgl_pengeluaran">Tanggal Pengeluaran:</label>
                                <input class="form-control" type="date" name="tgl_pengeluaran" id="tgl_pengeluaran"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="total">Total:</label>
                                <input class="form-control" type="number" name="total" id="total" required>
                            </div>

                            <div class="form-group">
                                <label for="keperluan">Keperluan:</label>
                                <textarea  class="form-control"  name="keperluan" id="keperluan" rows="4" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="bukti_pengeluaran">Bukti Pengeluaran:</label>
                                <input class="form-control" type="file" name="bukti_pengeluaran"
                                    id="bukti_pengeluaran" required>
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
