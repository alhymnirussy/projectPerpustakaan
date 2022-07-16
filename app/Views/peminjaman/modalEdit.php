<div class="modal" tabindex="-1" id="modalEdit">
  <div class="modal-dialog">
  <form action="/pinjam/update" id="formUpdate" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?= $title; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php foreach($peminjaman as $key => $value): ?>
          <div class="row mb-3">
              <label for="idPinjam" class="col-sm-4 col-form-label">Id Pinjam</label>
              <div class="col-sm-8">
                  <input type="text" class="form-control" id="idPinjam" name="id_pinjam" value="<?= $value['id_pinjam']; ?>" >
              </div>
            </div>
            <div class="row mb-3">
              <label for="idAnggota" class="col-sm-4 col-form-label">Id Anggota</label>
              <div class="col-sm-8">
                  <select class="form-select" aria-label="Default select example" name="id_anggota">
                      <option selected value="<?= $value['id_anggota']; ?>"><?= $value['id_anggota']; ?> - <?= $value['nama_anggota']; ?></option>
                      <?php foreach($anggota as $agt): ?>
                        <option value="<?= $agt['id_anggota']; ?>"><?= $agt['id_anggota']; ?> - <?= $agt['nama_anggota']; ?></option>
                      <?php endforeach; ?>
                  </select>
              </div>
            </div>
            <div class="row mb-3">
              <label for="idBuku" class="col-sm-4 col-form-label">Id Buku</label>
              <div class="col-sm-8">
                <select class="form-select" aria-label="Default select example" name="id_buku">
                      <option selected value="<?= $value['id_buku']; ?>"><?= $value['id_buku']; ?> - <?= $value['judul_buku']; ?></option>
                    <?php foreach($buku as $b): ?>
                      <option value="<?= $b['id_buku']; ?>"><?= $b['id_buku']; ?> - <?= $b['judul_buku']; ?></option>
                    <?php endforeach; ?>
                  </select>
              </div>
            </div>
            <div class="row mb-3">
              <label for="tglPinjam" class="col-sm-4 col-form-label">Tanggal Pinjam</label>
              <div class="col-sm-8">
                <input type="date" class="form-control" id="tglPinjam" name="tanggal_pinjam" value="<?= $value['tanggal_pinjam']; ?>">
              </div>
            </div>
            <div class="row mb-3">
              <label for="tglKembali" class="col-sm-4 col-form-label">Tanggal Kembali</label>
              <div class="col-sm-8">
                <input type="date" class="form-control" id="tglKembali" name="tanggal_kembali" value="<?= $value['tanggal_kembali']; ?>">
              </div>
            </div>
        <?php endforeach; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    $('#formUpdate').on('submit',function(e){
      e.preventDefault()
      let form = $(this);
      $.ajax({
        url: $(this).attr('action'),
        data:form.serialize(),
        dataType:'json',
        method:'post',
        success:function(response){
          if(response.sukses){
            Swal.fire({
              icon:'success',
              title:'Berhasil',
              text:response.sukses
            })
            $('#modalEdit').modal('hide');
            dataPeminjaman();
          }
        },
        error:function(xhr, ajaxOptions, throwError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
        }
      })
      return false;
    });
  })
</script>