<div class="modal" tabindex="-1" id="modalTambah">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?= $title_modal; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
            <form action="anggota/simpan" id="formTambah" method="post">
            <div class="row mb-3">
                <label for="inputid" class="col-sm-2 col-form-label">Id Anggota</label>   
                <div class="col-sm-10">   
                    <input type="text" class="form-control" id="inputId" name="id_anggota" readonly="true" value="<?= $id_baru; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputAnggota" class="col-sm-2 col-form-label">Nama Anggota</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputAnggota" name="nama_anggota">
                    <div class="invalid-feedback validasiAnggota"></div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputJenisKelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="jenis_kelamin" id="inputJenisKelamin">
                        <option selected value=""></option>
                        <option value="pria">Pria</option>
                        <option value="wanita">Wanita</option>
                    </select>
                    <div class="invalid-feedback validasiJenisKelamin"></div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputNoTelp" class="col-sm-2 col-form-label">No Telp</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputNoTelp" name="no_telp">
                    <div class="invalid-feedback validasiNoTelp"></div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputAlamat" name="alamat">
                    <div class="invalid-feedback validasiAlamat"></div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-10">
                    <input type="hidden" class="form-control" id="tanggal_daftar" name="tanggalDaftar" value="<?= $today; ?>">
                </div>
            </div>
            <div class="form-footer">
                <button type="submit" class="btn btn-info simpan">Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div> 
        </div>
    </div>
</div>

<script>
    
    $(document).ready(function(){
        $("#formTambah").on('submit', function(e) {
            e.preventDefault();
            let form = $(this);
            $.ajax({
                url: form.attr('action'),
                type: 'post',
                data: form.serialize(),
                dataType:'json',
                success: function(response){
                    if(response.error){
                        if(response.error.nama_anggota){
                            $('#inputAnggota').addClass('is-invalid');
                            $('.validasiAnggota').html(response.error.nama_anggota);
                        }else{
                            $('#inputAnggota').removeClass('is-invalid');
                            $('.validasiAnggota').html('');
                        }
                        if(response.error.jenis_kelamin){
                            $('#inputJenisKelamin').addClass('is-invalid');
                            $('.validasiJenisKelamin').html(response.error.jenis_kelamin);
                        }else{
                            $('#inputJenisKelamin').removeClass('is-invalid');
                            $('.validasiJenisKelamin').html('');
                        }
                        if(response.error.no_telp){
                            $('#inputNoTelp').addClass('is-invalid');
                            $('.validasiNoTelp').html(response.error.no_telp);
                        }else{
                            $('#inputNoTelp').removeClass('is-invalid');
                            $('.validasiNoTelp').html('');
                        }
                        if(response.error.alamat){
                            $('#inputAlamat').addClass('is-invalid');
                            $('.validasiAlamat').html(response.error.alamat);
                        }else{
                            $('#inputAlamat').removeClass('is-invalid');
                            $('.validasiAlamat').html('');
                        }
                    }
                    else{
                        Swal.fire({
                            icon: 'success',
                            title: 'Done!',
                            text: response.sukses
                        })
                        $('#modalTambah').modal('hide');
                        dataAnggota();
                    }
                },
                error:function(xhr, ajaxOptions, throwError){
                alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
            }
            });
            return false
        });
    })
</script>



 
