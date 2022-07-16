<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="container-pengembalian">

            <!-- isi dari container buku -->

            </div>
    </div>
    </div>
</div>

<div class="modalView"></div>

<script>
    // script untuk tampilkan buku dengan ajax
    function dataPengembalian(){
        $.ajax({
            url:"<?= site_url('kembali/dataPengembalian'); ?>",
            dataType:"json",
            success:function(response){
                $('.container-pengembalian').html(response.sukses);
            },
            error:function(xhr, ajaxOptions, throwError){
                alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
            }
        });
    }
    $(document).ready(function(){
        dataPengembalian();
    });

</script>
<!-- /.content-wrapper -->
<?= $this->endSection('content'); ?>






