<div class="modal" tabindex="-1" id="modalDetail">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?= $title; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mb-3">
            <label for="id_anggota" class="col-sm-3 col-form-label">Id Anggota</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="id_anggota" name="idAnggota" value="<?= $anggota['id_anggota']; ?>" readonly>
            </div>
        </div>
        <div class="row mb-3">
            <label for="nama_anggota" class="col-sm-3 col-form-label">Nama Anggota</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="nama_anggota" name="namaAnggota" value="<?= $anggota['nama_anggota']; ?>" readonly>
            </div>
        </div>
        <div class="row mb-3">
            <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="jenis_kelamin" name="jenisKelamin" value="<?= $anggota['jenis_kelamin']; ?>" readonly>
            </div>
        </div>
        <div class="row mb-3">
            <label for="no_telp" class="col-sm-3 col-form-label">No Telp</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="no_telp" name="noTelp" value="<?= $anggota['no_telp']; ?>" readonly>
            </div>
        </div>
        <div class="row mb-3">
            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $anggota['alamat']; ?>" readonly>
            </div>
        </div>
        <div class="row mb-3">
            <label for="tanggal_daftar" class="col-sm-3 col-form-label">Tanggal Daftar</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="tanggal_daftar" name="tanggalDaftar" value="<?= $anggota['tanggal_daftar']; ?>" readonly>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>