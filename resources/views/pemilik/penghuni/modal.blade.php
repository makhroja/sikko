<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card-header">
                <h4 class="modal-title" id="modelHeading">Tambah Penghuni</h4>
            </div>
            <form id="modalForm" name="modalForm" class="form-horizontal" method="POST"
                action="{{ route('penghuni.store') }}">
                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama" id="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="jk">Jenis Kelamin</label>
                                <select class="form-control" id="jk" name="jk" required>
                                    <option value="" disabled selected>Select Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea type="text" class="form-control" name="alamat" id="alamat" rows="4" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="no_hp">Nomor HP</label>
                                <input type="text" class="form-control" name="no_hp" id="no_hp" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" id="email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{-- <div class="form-group">
                                <label for="user_id">Penghuni</label>
                                <select type="text" class="form-control" name="user_id" id="user_id">
                                    <option value="">Pilih Penghuni</option>
                                    @foreach ($user as $u)
                                        <option value="{{ $u->id }}">{{ $u->nama }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="form-group">
                                <label for="kamar_id">Kamar ID</label>
                                <select type="text" class="form-control" name="kamar_id" id="kamar_id" required>
                                    <option value="" disabled selected>Select Kamar</option>
                                    @foreach ($kamar as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama_kost }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tgl_masuk">Tanggal Masuk</label>
                                <input type="date" class="form-control" name="tgl_masuk" id="tgl_masuk" required>
                            </div>
                            {{-- <div class="form-group">
                                <label for="tgl_keluar">Tanggal Keluar</label>
                                <input type="date" class="form-control" name="tgl_keluar" id="tgl_keluar" required>
                            </div> --}}
                            <div class="form-group">
                                <label for="status" class="col-sm-4 control-label">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tipe" class="col-sm-4 control-label">Tipe</label>
                                <select class="form-control" id="tipe" name="tipe" required>
                                    <option value="Bulanan">Bulanan</option>
                                    <option value="Tahunan">Tahunan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Update</button>
                    <button class="btn btn-danger float-right" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
