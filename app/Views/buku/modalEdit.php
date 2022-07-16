<div class="modal" tabindex="-1" id="modalEdit">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Form Edit Buku</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
            <form action="buku/update" id="formEdit" method="post">
            <input type="hidden" class="form-control" id="inputSlug" name="slug" value="<?= $slug; ?>">
            <div class="row mb-3">
                <label type="hidden" for="inputId" class="col-sm-2 col-form-label">Id Buku</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputId" name="id" readonly="true" value="<?= $id_buku; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputJudul" class="col-sm-2 col-form-label">Judul Buku</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputJudul" name="judul" value="<?= old('judul') ? old('judul') : $judul_buku ?>">
                    <div class="invalid-feedback validasiJudul"></div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputKategori" class="col-sm-2 col-form-label">Kategori</label>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="kategori" id="inputKategori">
                        <option selected value="<?= $kategori; ?>"><?= $kategori; ?></option>
                        <option value="anak-anak">anak anak</option>
                        <option value="ilmu-pengetahuan">Ilmu Pengetahuan</option>
                        <option value="geografis">Geografis</option>
                        <option value="biologi">Biologi</option>
                        <option value="matematika">Matematika</option>
                    </select>
                    <div class="invalid-feedback validasiKategori"></div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPengarang" class="col-sm-2 col-form-label">Pengarang</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPengarang" name="pengarang" value="<?= $pengarang; ?>">
                    <div class="invalid-feedback validasiPengarang"></div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPenerbit" class="col-sm-2 col-form-label">Penerbit</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPenerbit" name="penerbit" value="<?= $penerbit; ?>">
                    <div class="invalid-feedback validasiPenerbit"></div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputStok" class="col-sm-2 col-form-label">Stok</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputStok" name="stok" value="<?= $stok; ?>">
                    <div class="invalid-feedback validasiStok"></div>
                </div>
            </div>
            <div class="form-footer">
                <button type="submit" class="btn btn-info simpan">Simpan</button>
            </div>
            </form>
        </div> 
        </div>
    </div>
</div>

<script>

    $(document).ready(function(){
        $("#formEdit").on('submit', function(e) {
            e.preventDefault();
            let form = $(this);
            $.ajax({
                url: form.attr('action'),
                type: 'post',
                data: form.serialize(),
                dataType:'json',
                success: function(response){
                    if(response.error){
                        if(response.error.judul){
                            $('#inputJudul').addClass('is-invalid');
                            $('.validasiJudul').html(response.error.judul);
                        }else{
                            $('#inputJudul').removeClass('is-invalid');
                            $('.validasiJudul').html('');
                        }
                        if(response.error.kategori){
                            $('#inputKategori').addClass('is-invalid');
                            $('.validasiKategori').html(response.error.kategori);
                        }else{
                            $('#inputKategori').removeClass('is-invalid');
                            $('.validasiJudul').html('');
                        }
                        if(response.error.pengarang){
                            $('#inputPengarang').addClass('is-invalid');
                            $('.validasiPengarang').html(response.error.pengarang);
                        }else{
                            $('#inputPengarang').removeClass('is-invalid');
                            $('.validasiPengarang').html('');
                        }
                        if(response.error.penerbit){
                            $('#inputPenerbit').addClass('is-invalid');
                            $('.validasiPenerbit').html(response.error.penerbit);
                        }else{
                            $('#inputPenerbit').removeClass('is-invalid');
                            $('.validasiPenerbit').html('');
                        }
                        if(response.error.stok){
                            $('#inputStok').addClass('is-invalid');
                            $('.validasiStok').html(response.error.stok);
                        }
                        else{
                            $('#inputStok').removeClass('is-invalid');
                            $('.validasiStok').html('');
                        }
                    }
                    else{
                        Swal.fire({
                            icon: 'success',
                            title: 'Done!',
                            text: response.sukses
                        })
                        $('#modalEdit').modal('hide');
                        dataBuku();
                    }
                },
                error:function(xhr, ajaxOptions, throwError){
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
                }
            });
            return false
        });
    });
</script>
 
