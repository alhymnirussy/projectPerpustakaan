<div class="modal" tabindex="-1" id="modalTambah">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Form Tambah Buku</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
            <form action="buku/simpan" class="formBuku" id="formTambah" method="post" enctype="multipart/form-data">
            <div class="row mb-3">
                <label for="inputId" class="col-sm-2 col-form-label">Id Buku</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputId" name="id" readonly="true" value="<?= $id_generate; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputJudul" class="col-sm-2 col-form-label">Judul Buku</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputJudul" name="judul" >
                    <div class="invalid-feedback validasiJudul"></div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputKategori" class="col-sm-2 col-form-label">Kategori</label>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="kategori" id="inputKategori">
                        <option selected value="">---pilih---</option>
                        <option value="anak-anak">anak anak</option>
                        <option value="ilmu pengetahuan">Ilmu Pengetahuan</option>
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
                    <input type="text" class="form-control" id="inputPengarang" name="pengarang">
                    <div class="invalid-feedback validasiPengarang"></div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPenerbit" class="col-sm-2 col-form-label">Penerbit</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPenerbit" name="penerbit">
                    <div class="invalid-feedback validasiPenerbit"></div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputStok" class="col-sm-2 col-form-label">Stok</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputStok" name="stok" >
                    <div class="invalid-feedback validasiStok"></div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-2">
                    <label for="inputFile" name="label">File</label>
                </div>
                <div class="col-sm-2">
                    <img src="/img/no_image.jpeg" alt="" class="thumbnail" style="width:100px;height:140px">
                </div>
                <div class="col-sm-8">
                <input type="file" class="form-control" id="inputFile" name="file" onchange="thumbnailImage()">
                <div class="invalid-feedback validasiFile"></div>
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
    function thumbnailImage(){
        const cover = document.querySelector('#inputFile');
        const thumbnail = document.querySelector('.thumbnail');

        const fileCover = new FileReader();

        fileCover.readAsDataURL(cover.files[0]);

        fileCover.onload = function(e){
            thumbnail.src = e.target.result;
        }
    }
    $(document).ready(function(){
        $("#formTambah").on('submit', function(e) {
            e.preventDefault();
            let form = $('.formBuku')[0];
            let data = new FormData(form);
            $.ajax({
                type: "post",
                url: "<?= site_url('buku/simpan'); ?>",
                data:data,
                enctype : "multipart/form-data",
                processData: false,
                contentType: false,
                cache:false,
                dataType:"json",
                success: function(response){
                    if(response.error){
                        if(response.error.id){
                            $('#inputId').addClass('is-invalid');
                            $('.validasiId').html(response.error.id);
                        }else{
                            $('#inputId').removeClass('is-invalid');
                            $('.validasiId').html('');
                        }
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
                            $('.validasiKategori').html('');
                        }
                        if(response.error.pengarang){
                            $('#inputPengarang').addClass('is-invalid');
                            $('.validasiPengarang').html(response.error.pengarang);
                        }
                        else{
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
                        }else{
                            $('#inputStok').removeClass('is-invalid');
                            $('.validasiStok').html('');
                        }
                        if(response.error.file){
                            $('#inputFile').addClass('is-invalid');
                            $('.validasiFile').html(response.error.file);
                        }else{
                            $('#inputFile').removeClass('is-invalid');
                            $('.validasiFile').html('');
                        }          
                    }
                    else{
                        Swal.fire({
                            icon: 'success',
                            title: 'Done!',
                            text: response.sukses
                        })
                        $('#modalTambah').modal('hide');
                        dataBuku();
                    }
                    
                },
                error:function(xhr, ajaxOptions, throwError){
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
                }
            });

        })       
    });
</script>
 
