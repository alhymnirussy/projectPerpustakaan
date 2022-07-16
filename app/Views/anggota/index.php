<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <!-- <button class="btn btn-warning" onclick="tambahBanyak()"><i class="bi bi-trash-fill me-2"></i>Tambah Banyak</button> -->
        <div class="containerAnggota mt-4"></div>
         <!-- Small boxes (Stat box) -->
        </div>
    </div>
</div>

<div class="modalView" style="display:none;"></div>

<script>

    function dataAnggota(){
        $.ajax({
            url: "<?= site_url('anggota/dataAnggota'); ?>",
            dataType:'json',
            success:function(response){
                if(response.sukses){
                    $('.containerAnggota').html(response.sukses);
                }
            },
            error:function(xhr, ajaxOptions, throwError){
                alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
            }
        })
    }

    $(document).ready(function(){
        dataAnggota();
        $('.buttonTambah').click(function(e){
            e.preventDefault();
            $.ajax({
                url:"<?= site_url('anggota/tambah') ?>",
                dataType:"json",
                success:function(response){
                    $('.modalView').html(response.data).show();
                    $('#modalTambah').modal('show');
                },
                error:function(xhr,ajaxOptions,throwError){
                    alert(xhr.status + "\n" + xhr.response.Text + "\n" + throwError);
                }
            })

        });
    });

    function tambah(){
        $.ajax({
            url:"<?= site_url('anggota/tambah'); ?>",
            dataType:'json',
            success:function(response){
                if(response.sukses){
                    $('.modalView').html(response.sukses).show();
                    $('#modalTambah').modal('show');
                }
            },
            error:function(xhr, ajaxOptions, throwError){
                alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
            }
        })
    }
    function tambahBanyak(){
        $.ajax({
            url:"<?= site_url('anggota/tambahBanyak'); ?>",
            dataType:'json',
            success:function(response){
                if(response.sukses){
                    $('.containerAnggota').html(response.sukses);
                }
            },
            error:function(xhr, ajaxOptions, throwError){
                alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
            }
        })
    }
    
    </script>
<!-- /.content-wrapper -->
<?= $this->endSection('content'); ?>
