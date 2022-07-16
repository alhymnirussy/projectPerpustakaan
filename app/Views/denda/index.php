<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="container-denda">

            <!-- isi dari container buku -->

            </div>
    </div>
    </div>
</div>

<div class="modalView"></div>

<script>

function dataDenda(){
        $.ajax({
            url:"<?= site_url('denda/dataDenda'); ?>",
            dataType:"json",
            success:function(response){
                $('.container-denda').html(response.sukses);
            },
            error:function(xhr, ajaxOptions, throwError){
                alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
            }
        });
    }
    $(document).ready(function(){
        dataDenda();
    });

</script>
<!-- /.content-wrapper -->
<?= $this->endSection('content'); ?>






