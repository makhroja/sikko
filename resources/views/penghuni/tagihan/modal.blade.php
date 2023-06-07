<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card-header">
                <h4 class="modal-title" id="modelHeading">Pembayaran Tagihan</h4>

            </div>
            <form id="modalForm" name="modalForm" class="form-horizontal" method="POST"
                action="{{ route('penghuni.bayar') }}" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    <input type="hidden" id="tagihan_id" name="tagihan_id" value="">
                    <div class="form-group">
                        <label for="no_faktur">Nomor Faktur:</label>
                        <input class="form-control col-md-3" type="text" id="no_faktur" value="{{generateNoFaktur()}}" name="no_faktur" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="metode_pembayaran">Metode Pembayaran:</label>
                        <input class="form-control col-md-9" type="text" id="metode_pembayaran"
                            name="metode_pembayaran" required>
                    </div>
                    <div class="form-group">
                        <label for="total_bayar">Total Pembayaran:</label>
                        <input class="form-control col-md-6" type="number" id="total_bayar"
                            name="total_bayar" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="bukti_pembayaran">Bukti Pembayaran:</label>
                        <input class="form-control col-md-6" type="file" id="bukti_pembayaran" name="bukti_pembayaran" accept=".jpg, .jpeg, .png" required>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Kirim Bukti Pembayaran</button>
                    <button class="btn btn-danger float-right" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
