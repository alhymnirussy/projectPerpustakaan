<div class="modal" tabindex="-1" id="modalTambah">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?= $title; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="/pinjam/simpan" class="simpanPinjam" id="formPinjam" method="POST">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="card">
                                <div class="card-body p-0 m-2">
                                    <div class="isi" style="text-align:center;">
                                        <p><b>ID PEMINJAMAN</b><br><?= $id_baru; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                <h5 class="card-title mb-2"><b>PILIH BUKU</b></h5>
                                    <select class="form-select" name="pilihBuku" id="pilihBuku">
                                        <option selected value="">No selected</option>
                                        <?php foreach($buku as $b): ?>
                                            <option class="mb-1" value="<?= $b['id_buku']; ?>"><?= $b['id_buku']; ?> -- <?= $b['judul_buku']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback validasiBuku"></div>
                                </div>
                            </div>
                            <div class="card mt-2">
                                <div class="card-body">
                                <h5 class="card-title text-center mb-2"><b>PILIH ANGGOTA</b></h5>
                                    <select class="form-select"  name="pilihAnggota" id="pilihAnggota">
                                        <option value="">No selected</option>
                                        <?php foreach($anggota as $a): ?>
                                            <option value="<?= $a['id_anggota']; ?>"><?= $a['id_anggota']; ?> -- <?= $a['nama_anggota']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback validasiAnggota"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-7">
                        <div class="card" style="height:94.5%;">
                            <div class="card-body">
                                <h5 class="card-title"><b>DATA BUKU</b></h5><br>
                                <div class="row" id="containerBuku">

                                </div>
                                
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-sm-5">
                            <div class="card" style="height:224px;">
                                <div class="card-body">
                                    <h5 class="card-title text-center"><b>PILIH TANGGAL</b></h5>
                                    <div class="row mt-4">
                                        <div class="col-5">
                                            <label class="col-form-label" for="date">Tanggal Pinjam : </label>
                                        </div>
                                        <div class="col-7">
                                            <input type="date" id="date" name="tanggalPinjam" class="form-control">
                                            <div class="invalid-feedback validasiTanggalPinjam"></div>
                                        </div>   
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-5">
                                            <label class="col-form-label" for="date">Tanggal Kembali : </label>
                                        </div>
                                        <div class="col-7">
                                            <input type="date" id="date" name="tanggalKembali" class="form-control">
                                            <div class="invalid-feedback validasiTanggalKembali"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-7">
                        <div class="card" style="height:224px;">
                            <div class="card-body">
                                <h5 class="card-title text-center"><b>DATA ANGGOTA</b></h5><br>
                                <div class="containerAnggota mt-4" id="containerAnggota"></div>      
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
     //script select 2
            $("#pilihBuku").on('change', function() {
                var id = $(this).val();
                if(id){
                    $.ajax ({
                        type: 'POST',
                        url: '<?= base_url('pinjam/tampilBuku'); ?>',
                        data: { dataId : id },
                        dataType : 'json',
                        success : function(response) {
                            if(response.sukses){
                                $('#containerBuku').html(response.sukses)
                            }
                        },
                        error:function(xhr, ajaxOptions, throwError){
                          alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
                        }
                    });
                }
            });
         
            $("#pilihAnggota").on('change', function() {
                var id = $(this).val();
                if(id){
                    $.ajax ({
                        type: 'POST',
                        url: '<?= base_url('pinjam/tampilAnggota'); ?>',
                        data: { dataId : id },
                        dataType : 'json',
                        success : function(response) {
                            if(response.sukses){
                                $('#containerAnggota').html(response.sukses)
                            }
                        },
                        error:function(xhr, ajaxOptions, throwError){
                          alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
                        }
                    });
                }
            });
</script>

