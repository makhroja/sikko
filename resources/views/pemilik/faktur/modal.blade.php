<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card-header">
                <h4 class="modal-title" id="modelHeading">Tambah Faktur</h4>
            </div>
            <form id="modalForm" name="modalForm" class="form-horizontal" method="POST"
                action="{{ route('faktur.store') }}" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    <div class="form-group">
                        <label for="no_faktur">Nomor Faktur:</label>
                        <input class="form-control col-md-3" type="text" id="no_faktur" value="{{generateNoFaktur()}}" name="no_faktur" required readonly>
                    </div>
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="tagihan_id">Tagihan</label>
                                <select name="tagihan_id" id="tagihan_id">
                                    <option value="">Pilih Tagihan</option>
                                    @foreach ($tagihan as $tagihan)
                                        <option value="{{ $tagihan->id }}">{{ $tagihan->no_tagihan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="total_bayar">Total Bayar:</label>
                                <input class="form-control" type="text" id="total_bayar" name="total_bayar" required>
                            </div>
                            <div class="form-group">
                                <label for="tgl_bayar">Tanggal Bayar:</label>
                                <input class="form-control" type="date" id="tgl_bayar" name="tgl_bayar" required>
                            </div>
                        </div>
                        <div class="col-md">

                            <div class="form-group">
                                <label for="metode_pembayaran">Metode Pembayaran:</label>
                                <input class="form-control" type="text" id="metode_pembayaran"
                                    name="metode_pembayaran" required>
                            </div>
                            <div class="form-group">
                                <label for="bukti_pembayaran">Bukti Pembayaran:</label>
                                <input class="form-control" type="file" id="bukti_pembayaran" name="bukti_pembayaran" accept=".jpg, .jpeg, .png" required>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="1">Selesai</option>
                                    <option value="0">Belum</option>
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
