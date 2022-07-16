<div class="modal" tabindex="-1" id="modalDetail">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mb-3">
            <label for="id_buku" class="col-sm-3 col-form-label">Id Buku</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="id_buku" name="idBuku" value="<?= $buku['id_buku']; ?>" readonly>
            </div>
        </div>
        <div class="row mb-3">
            <label for="judul_buku" class="col-sm-3 col-form-label">Judul Buku</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="judul_buku" name="judulBuku" value="<?= $buku['judul_buku']; ?>" readonly>
            </div>
        </div>
        <div class="row mb-3">
            <label for="ketagori" class="col-sm-3 col-form-label">Kategori</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="kategori" name="kategori" value="<?= $buku['kategori']; ?>" readonly>
            </div>
        </div>
        <div class="row mb-3">
            <label for="penerbit" class="col-sm-3 col-form-label">Penerbit</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= $buku['penerbit']; ?>" readonly>
            </div>
        </div>
        <div class="row mb-3">
            <label for="stok" class="col-sm-3 col-form-label">Stok</label>
            <div class="col-sm-9">
            <?php $stok = $buku['stok'];
                if($stok == 0){?>
                    <button type="button" class="btn btn-danger"><b><?= $buku['stok']; ?></b></button>
                <?php }else{ ?>
                    <button type="button" class="btn btn-success"><b><?= $buku['stok']; ?></b></button>
                <?php }; ?>
            </div>
        </div>
        <div class="row mb-3">
            <label for="cover" class="col-sm-3 col-form-label">Cover</label>
            <div class="col-sm-9">
                <div class="cover" style="width:150px;height:180px;">
                    <img src="/assets/img/<?= $buku['cover']; ?>" alt="cover" style="width:100%;height:100%;box-shadow: 10px 10px 5px #888888;">
                </div> 
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>