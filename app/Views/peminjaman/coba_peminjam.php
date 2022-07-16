<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <form action="/pinjam/simpan" class="simpanPinjam" id="formPinjam" method="POST">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="card">
                            <div class="card-body p-0 m-2">
                                <div class="isi" style="text-align:center;">
                                    <p><b>ID PEMINJAMAN</b><br><?= $id_baru; ?></p>
                                    <input type="hidden" name="id_pinjam" value="<?= $id_baru; ?>">
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
                                <div class="row" id="containerBuku"></div>
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
                                        <label class="col-form-label" for="tanggalPinjam">Tanggal Pinjam : </label>
                                    </div>
                                    <div class="col-7">
                                        <input type="date" id="tanggalPinjam" name="tanggalPinjam" class="form-control">
                                        <div class="invalid-feedback validasiTanggalPinjam"></div>
                                    </div>   
                                </div>
                                <div class="row mt-4">
                                    <div class="col-5">
                                        <label class="col-form-label" for="tanggalKembali">Tanggal Kembali : </label>
                                    </div>
                                    <div class="col-7">
                                        <input type="date" id="tanggalKembali" name="tanggalKembali" class="form-control">
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
    </div>
</div>

<script>
            //script select 2

            $('#pilihBuku').select2({
            });
            $('#pilihAnggota').select2({
            });
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

    $(document).ready(function(){
        $(".simpanPinjam").submit(function(e) {
            e.preventDefault();
            let form = $(this);
            $.ajax({
                url: form.attr('action'),
                type: 'post',
                data: form.serialize(),
                dataType:'json',
                success: function(response){
                    if(response.error){
                        if(response.error.pilihBuku){
                            $('#pilihBuku').addClass('is-invalid');
                            $('.validasiBuku').html(response.error.pilihBuku);
                        }else{
                            $('#pilihBuku').removeClass('is-invalid');
                            $('.validasiBuku').html('');
                        }
                        if(response.error.pilihAnggota){
                            $('#pilihAnggota').addClass('is-invalid');
                            $('.validasiAnggota').html(response.error.pilihAnggota);
                        }else{
                            $('#pilihAnggota').removeClass('is-invalid');
                            $('.validasiAnggota').html('');
                        }
                        if(response.error.tanggalPinjam){
                            $('#tanggalPinjam').addClass('is-invalid');
                            $('.validasiTanggalPinjam').html(response.error.tanggalPinjam);
                        }else{
                            $('#tanggalPinjam').removeClass('is-invalid');
                            $('.validasiTanggalPinjam').html('');
                        }
                        if(response.error.tanggalKembali){
                            $('#tanggalKembali').addClass('is-invalid');
                            $('.validasiTanggalKembali').html(response.error.tanggalKembali);
                        }else{
                            $('#tanggalKembali').removeClass('is-invalid');
                            $('.validasiTanggalKembali').html('');
                        }
                    }if(response.errors){
                        Swal.fire({
                            title:'Failed',
                            icon:'warning',
                            text:response.errors,
                        });
                    }
                    if(response.sukses){
                        Swal.fire({
                            title: 'Done',
                            text: response.sukses,
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OKE'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/pinjam';
                            }
                            else{
                                window.location.href = '/pinjam';
                            }
                        })
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






<?= $this->endSection('content'); ?>