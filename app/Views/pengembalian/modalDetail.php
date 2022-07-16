<div class="modal" tabindex="-1" id="modalDetail">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Peminjaman</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
          <?php foreach($detail as $key => $value): ?>
          <div class="row">
            <div class="col-sm-6">
              <div class="card">
                <div class="card-header">
                  <b>Detail Anggota</b>
                </div>
                <div class="card-body">
                  <p class="card-text"><small><b>Id Anggota : </b><?= $value['id_anggota']; ?></small></p>
                  <p class="card-text"><small><b>Nama Anggota : </b><?= $value['nama_anggota']; ?></small></p>
                  <p class="card-text"><small><b>Jenis Kelamin : </b><?= $value['jenis_kelamin']; ?></small></p>
                  <p class="card-text"><small><b>No Telp : </b><?= $value['no_telp']; ?></small></p>
                  <p class="card-text"><small><b>Alamat : </b><?= $value['alamat']; ?></small></p>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card">
                <div class="card-header">
                  <b>Detail Buku</b>
                </div>
                <div class="card-body">
                  <p class="card-text"><small><b>Id Buku : </b><?= $value['id_buku']; ?></small></p>
                  <p class="card-text"><small><b>Judul Buku : </b><?= $value['judul_buku']; ?></small></p>
                  <p class="card-text"><small><b>Kategori : </b><?= $value['kategori']; ?></small></p>
                  <p class="card-text"><small><b>Pengarang : </b><?= $value['pengarang']; ?></small></p>
                  <p class="card-text"><small><b>Penerbit : </b><?= $value['penerbit']; ?></small></p>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card">
                <div class="card-header">
                  <b>Detail Peminjaman</b>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead style="text-align:center;">
                        <tr>
                          <th scope="col">Id Peminjaman</th>
                          <th scope="col">Tanggal Pinjam</th>
                          <th scope="col">Tanggal Kembali</th>
                          <th scope="col">Dikembalikan pada</th>
                          <th scope="col">Denda yang Dibayar</th>
                        </tr>
                      </thead>
                      <tbody style="text-align:center;">
                        <tr>
                          <td><?= $value['id_pinjam']; ?></td>
                          <td><?= $value['tanggal_pinjam']; ?></td>
                          <td><?= $value['tanggal_kembali']; ?></td>
                          <td><?= $value['dikembalikan_pada']; ?></td>
                          <td>
                            <?php $denda = $value['denda']; ?>
                            <?php if($denda == 0){ ?>
                                <button type="button" class="btn btn-success">Free</button>
                            <?php }else{?>
                                <button type="button" class="btn btn-danger"><?= "Rp. ".$denda ?></button>
                            <?php }; ?>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          </div>
        </div>
          <?php endforeach; ?>
      </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary d-inline" data-bs-dismiss="modal">Close</button>
      </div>
        </div>
    </div>
</div>


